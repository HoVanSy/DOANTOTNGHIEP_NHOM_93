# Chatbot AI Setup Guide

## Tổng quan

Chatbot AI cho ứng dụng tour du lịch VivuTour với các tính năng:

- Tư vấn tour du lịch
- Đặt tour online
- Lên lịch trình tự động
- Gợi ý khách sạn
- Trả lời FAQ
- Kết nối dữ liệu thật

## Cấu trúc Project

### Frontend (Vue.js)

- Component: `src/layout/components/ChatbotAI.vue`
- Service: `src/core/chatbotService.js`
- Đã tích hợp vào layout client

### Backend (Node.js) - Cần tạo

## Hướng dẫn Setup Backend

### 1. Tạo Project Node.js

```bash
mkdir tour-chatbot-backend
cd tour-chatbot-backend
npm init -y
```

### 2. Cài đặt Dependencies

```bash
npm install express cors helmet dotenv
npm install @google-cloud/dialogflow axios openai
npm install mongoose bcryptjs jsonwebtoken
npm install -D nodemon
```

### 3. Cấu trúc Backend

```
backend/
├── src/
│   ├── controllers/
│   │   ├── chatbotController.js
│   │   ├── tourController.js
│   │   └── userController.js
│   ├── models/
│   │   ├── Tour.js
│   │   ├── User.js
│   │   └── ChatHistory.js
│   ├── routes/
│   │   ├── chatbot.js
│   │   ├── tours.js
│   │   └── users.js
│   ├── services/
│   │   ├── aiService.js
│   │   ├── nlpService.js
│   │   └── tourService.js
│   ├── middleware/
│   │   └── auth.js
│   ├── config/
│   │   └── database.js
│   └── app.js
├── .env
├── package.json
└── server.js
```

### 4. File server.js

```javascript
const express = require("express");
const cors = require("cors");
const helmet = require("helmet");
require("dotenv").config();

const app = express();
const PORT = process.env.PORT || 3000;

// Middleware
app.use(helmet());
app.use(cors());
app.use(express.json());

// Routes
app.use("/api/chatbot", require("./src/routes/chatbot"));
app.use("/api/tours", require("./src/routes/tours"));
app.use("/api/users", require("./src/routes/users"));

// Health check
app.get("/health", (req, res) => {
  res.json({ status: "OK", timestamp: new Date() });
});

app.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`);
});
```

### 5. AI Service (OpenAI)

```javascript
// src/services/aiService.js
const OpenAI = require("openai");

class AIService {
  constructor() {
    this.openai = new OpenAI({
      apiKey: process.env.OPENAI_API_KEY,
    });
  }

  async generateResponse(message, context = {}) {
    try {
      const systemPrompt = `Bạn là trợ lý AI chuyên nghiệp của công ty du lịch VivuTour.
      Nhiệm vụ của bạn là tư vấn tour du lịch, giúp khách hàng đặt tour, lên lịch trình,
      gợi ý khách sạn và trả lời các câu hỏi về du lịch Việt Nam.

      Thông tin công ty:
      - Hotline: 0935532543
      - Email: vivutour@gmail.com
      - Địa chỉ: 32 Xuân Diệu, Thuận Phước, Hải Châu, Đà Nẵng

      Hãy trả lời một cách thân thiện, chuyên nghiệp và hữu ích.`;

      const completion = await this.openai.chat.completions.create({
        model: "gpt-3.5-turbo",
        messages: [
          { role: "system", content: systemPrompt },
          { role: "user", content: message },
        ],
        max_tokens: 500,
        temperature: 0.7,
      });

      return completion.choices[0].message.content;
    } catch (error) {
      console.error("OpenAI API Error:", error);
      throw error;
    }
  }
}

module.exports = new AIService();
```

### 6. Chatbot Controller

```javascript
// src/controllers/chatbotController.js
const aiService = require("../services/aiService");
const ChatHistory = require("../models/ChatHistory");

class ChatbotController {
  async sendMessage(req, res) {
    try {
      const { message, context } = req.body;

      // Lưu tin nhắn vào database
      const chatHistory = new ChatHistory({
        userId: context.userId || "anonymous",
        sessionId: context.sessionId,
        message: message,
        sender: "user",
        timestamp: new Date(),
      });
      await chatHistory.save();

      // Gọi AI service
      const aiResponse = await aiService.generateResponse(message, context);

      // Lưu phản hồi của bot
      const botHistory = new ChatHistory({
        userId: context.userId || "anonymous",
        sessionId: context.sessionId,
        message: aiResponse,
        sender: "bot",
        timestamp: new Date(),
      });
      await botHistory.save();

      res.json({
        message: aiResponse,
        sessionId: context.sessionId,
        timestamp: new Date(),
      });
    } catch (error) {
      console.error("Chatbot error:", error);
      res.status(500).json({
        error: "Internal server error",
        message: "Xin lỗi, có lỗi xảy ra. Vui lòng thử lại sau.",
      });
    }
  }

  async getChatHistory(req, res) {
    try {
      const { userId } = req.params;
      const { limit = 50 } = req.query;

      const history = await ChatHistory.find({ userId })
        .sort({ timestamp: -1 })
        .limit(parseInt(limit));

      res.json(history.reverse());
    } catch (error) {
      console.error("Get chat history error:", error);
      res.status(500).json({ error: "Internal server error" });
    }
  }
}

module.exports = new ChatbotController();
```

### 7. File .env

```
PORT=3000
MONGODB_URI=mongodb://localhost:27017/vivutour_chatbot
OPENAI_API_KEY=your_openai_api_key_here
JWT_SECRET=your_jwt_secret_here
NODE_ENV=development
```

### 8. Chạy Backend

```bash
npm run dev
# hoặc
nodemon server.js
```

## Frontend Configuration

### Cập nhật .env cho Vue.js

```env
VUE_APP_API_URL=http://localhost:3000/api
```

## Tính năng nâng cao

### 1. Dialogflow Integration

```javascript
// src/services/dialogflowService.js
const dialogflow = require("@google-cloud/dialogflow");

class DialogflowService {
  async detectIntent(message, sessionId) {
    const sessionClient = new dialogflow.SessionsClient();
    const sessionPath = sessionClient.projectAgentSessionPath(
      process.env.DIALOGFLOW_PROJECT_ID,
      sessionId,
    );

    const request = {
      session: sessionPath,
      queryInput: {
        text: {
          text: message,
          languageCode: "vi",
        },
      },
    };

    const responses = await sessionClient.detectIntent(request);
    return responses[0].queryResult;
  }
}
```

### 2. Database Models

```javascript
// src/models/Tour.js
const mongoose = require("mongoose");

const tourSchema = new mongoose.Schema(
  {
    name: { type: String, required: true },
    destination: { type: String, required: true },
    duration: { type: Number, required: true },
    price: { type: Number, required: true },
    description: String,
    highlights: [String],
    inclusions: [String],
    exclusions: [String],
    itinerary: [
      {
        day: Number,
        title: String,
        description: String,
        meals: [String],
      },
    ],
    images: [String],
    category: String,
    rating: { type: Number, default: 0 },
    reviews: [{ type: mongoose.Schema.Types.ObjectId, ref: "Review" }],
    isActive: { type: Boolean, default: true },
  },
  { timestamps: true },
);

module.exports = mongoose.model("Tour", tourSchema);
```

## Testing

### Test Chatbot

```bash
curl -X POST http://localhost:3000/api/chatbot/message \
  -H "Content-Type: application/json" \
  -d '{
    "message": "Tôi muốn đặt tour Đà Nẵng",
    "context": {
      "sessionId": "test_session_123"
    }
  }'
```

## Deployment

### 1. Build Frontend

```bash
npm run build
```

### 2. Deploy Backend lên Heroku/VPS

```bash
heroku create your-app-name
git push heroku main
```

### 3. Cập nhật API URL trong .env.production

## Lưu ý

- Thay thế `your_openai_api_key_here` bằng API key thực của OpenAI
- Setup MongoDB database
- Cấu hình CORS cho production
- Thêm authentication cho các API cần bảo mật
