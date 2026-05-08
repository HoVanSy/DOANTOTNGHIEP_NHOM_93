<template>
  <div class="vivu-chatbot-wrapper">
    
    <div class="vivu-chat-container" v-show="isOpen">
      <div class="vivu-chat-header">
        <h4>🤖 Tour Assistant</h4>
        <button class="vivu-close-btn" @click="toggleChat">✖</button>
      </div>

      <div class="vivu-chat-messages" ref="messagesContainer">
        <div v-for="message in messages" :key="message.id" :class="['vivu-message', message.sender]">
          <strong>{{ message.sender === 'user' ? 'Bạn' : 'Bot' }}:</strong> 
          <span>{{ message.text }}</span>
        </div>

        <div v-if="isTyping" class="vivu-message bot">
          <em>Bot đang gõ...</em>
        </div>
      </div>
  
      <div class="vivu-chat-input">
        <input 
          v-model="userInput" 
          @keypress.enter="sendMessage" 
          placeholder="Nhập câu hỏi..." 
          :disabled="isTyping"
        >
        <button @click="sendMessage" :disabled="isTyping || !userInput.trim()">Gửi</button>
      </div>
    </div>

    <!-- Nút bong bóng -->
    <button class="vivu-toggle-btn" @click="toggleChat">
      {{ isOpen ? '✖' : '💬' }}
    </button>
    
  </div>
</template>

<script>
import chatbotService from '../../core/chatbotService.js';

export default {
  name: 'ChatbotAI',
  data() {
    return {
      isOpen: false, 
      messages: [
        { id: 1, sender: 'bot', text: 'Xin chào! Tôi có thể tư vấn tour gì cho bạn hôm nay?' }
      ],
      userInput: '',
      isTyping: false,
      messageId: 2
    }
  },
  methods: {
    toggleChat() {
      this.isOpen = !this.isOpen;
      if (this.isOpen) {
        this.scrollToBottom();
      }
    },

    async sendMessage() {
      if (!this.userInput.trim() || this.isTyping) return;

      const text = this.userInput.trim();
      
      this.messages.push({ id: this.messageId++, sender: 'user', text: text });
      this.userInput = '';
      this.isTyping = true;
      this.scrollToBottom();

      try {
        const response = await chatbotService.sendMessage(text);
        
        this.messages.push({ 
          id: this.messageId++, 
          sender: 'bot', 
          text: response.data || response 
        });
      } catch (error) {
        this.messages.push({ 
          id: this.messageId++, 
          sender: 'bot', 
          text: 'Lỗi kết nối, vui lòng thử lại sau!' 
        });
      } finally {
        this.isTyping = false;
        this.scrollToBottom();
      }
    },

    scrollToBottom() {
      this.$nextTick(() => {
        const container = this.$refs.messagesContainer;
        if (container) {
          container.scrollTop = container.scrollHeight;
        }
      });
    }
  }
}
</script>

<style scoped>
.vivu-chatbot-wrapper {
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 999999; /* Đẩy lên cao nhất có thể */
  display: flex;
  flex-direction: column;
  align-items: flex-end; 
}

.vivu-toggle-btn {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background-color: #007bff;
  color: white;
  font-size: 24px;
  border: none;
  cursor: pointer;
  box-shadow: 0 4px 12px rgba(0,0,0,0.3);
  margin-top: 15px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background-color 0.3s;
}

.vivu-toggle-btn:hover {
  background-color: #0056b3;
}

.vivu-chat-container {
  width: 350px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-family: sans-serif;
  background: #fff;
  display: flex;
  flex-direction: column;
  box-shadow: 0 5px 25px rgba(0,0,0,0.2); 
}

.vivu-chat-header {
  background: #eee;
  padding: 10px 15px;
  border-bottom: 1px solid #ccc;
  border-radius: 8px 8px 0 0;
  display: flex;
  justify-content: space-between; 
  align-items: center;
}

.vivu-chat-header h4 {
  margin: 0;
}

.vivu-close-btn {
  background: none;
  border: none;
  font-size: 18px;
  cursor: pointer;
  color: #555;
}

.vivu-close-btn:hover {
  color: red;
}

.vivu-chat-messages {
  height: 350px; 
  overflow-y: auto;
  padding: 15px;
  background: #f9f9f9;
}

.vivu-message {
  margin-bottom: 10px;
  padding: 8px 12px;
  border-radius: 4px;
  line-height: 1.4;
}

.vivu-message.user {
  background: #e3f2fd;
  text-align: right;
}

.vivu-message.bot {
  background: #fff;
  border: 1px solid #ddd;
  text-align: left;
}

.vivu-chat-input {
  display: flex;
  padding: 10px;
  border-top: 1px solid #ccc;
  background: #fff;
  border-radius: 0 0 8px 8px;
}

.vivu-chat-input input {
  flex: 1;
  padding: 8px 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-right: 5px;
  outline: none;
}

.vivu-chat-input input:focus {
  border-color: #007bff;
}

.vivu-chat-input button {
  padding: 8px 15px;
  cursor: pointer;
  background: #007bff;
  color: white;
  border: none;
  border-radius: 4px;
}

.vivu-chat-input button:disabled {
  background: #ccc;
  cursor: not-allowed;
}
</style>