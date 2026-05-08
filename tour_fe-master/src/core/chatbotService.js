import baseRequest from './baseRequestClient';

class ChatbotService {
  
  async sendMessage(question, context = {}) {
    try {
      const response = await baseRequest.post('chatbot/question', {
        question: question,
        context: context,
        timestamp: new Date().toISOString()
      });

      return response.data;
    } catch (error) {
      console.error('Chatbot API Error:', error);
      throw error;
    }
  }

  
  async getChatHistory(userId, limit = 50) {
    try {
      const response = await baseRequest.get(`/chatbot/history/${userId}`, {
        params: { limit }
      });

      return response.data;
    } catch (error) {
      console.error('Get chat history error:', error);
      throw error;
    }
  }
}

// Tạo instance duy nhất
const chatbotService = new ChatbotService();

export default chatbotService;