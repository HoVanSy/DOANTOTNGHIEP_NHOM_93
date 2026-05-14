<template>
  <div class="vivu-chatbot-wrapper">
    
    <div class="vivu-chat-container animate__animated animate__fadeInUp animate__faster" v-show="isOpen">
      
      <div class="vivu-chat-header">
        <div class="d-flex align-items-center gap-2">
            <div class="bot-avatar">
                <i class="fa-solid fa-robot"></i>
            </div>
            <div>
                <h6 class="mb-0 text-white fw-bold">VIVU Tour AI</h6>
                <small class="text-white-50 font-11"><i class="fa-solid fa-circle text-success me-1"></i>Đang trực tuyến</small>
            </div>
        </div>
        <button class="vivu-close-btn" @click="toggleChat">
            <i class="fa-solid fa-chevron-down"></i>
        </button>
      </div>

      <div class="vivu-chat-messages" ref="messagesContainer">
        <div v-for="message in messages" :key="message.id" :class="['message-row', message.sender]">
            
            <div v-if="message.sender === 'bot'" class="avatar-small">
                <i class="fa-solid fa-robot"></i>
            </div>

            <div class="message-bubble">
                <span v-html="formatMessage(message.text)"></span>
            </div>

        </div>

        <div v-if="isTyping" class="message-row bot">
            <div class="avatar-small">
                <i class="fa-solid fa-robot"></i>
            </div>
            <div class="message-bubble typing-indicator">
                <span></span><span></span><span></span>
            </div>
        </div>
      </div>
  
      <div class="vivu-chat-input">
        <input 
          v-model="userInput" 
          @keypress.enter="sendMessage" 
          placeholder="Nhập câu hỏi của bạn..." 
          :disabled="isTyping"
        >
        <button class="send-btn" @click="sendMessage" :disabled="isTyping || !userInput.trim()">
            <i class="fa-solid fa-paper-plane"></i>
        </button>
      </div>
    </div>

    <button class="vivu-toggle-btn" :class="{'pulse-animation': !isOpen}" @click="toggleChat">
        <i v-if="isOpen" class="fa-solid fa-xmark"></i>
        <i v-else class="fa-solid fa-comment-dots"></i>
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
        { id: 1, sender: 'bot', text: 'Xin chào! 👋 Tôi là trợ lý ảo của VietTour. Tôi có thể giúp gì cho bạn hôm nay?' }
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
          text: 'Xin lỗi, tôi đang gặp sự cố kết nối. Vui lòng thử lại sau nhé!' 
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
    },

    // Hàm chuyển đổi "\n" thành thẻ <br> để bot xuống dòng đẹp hơn
    formatMessage(text) {
        if (!text) return '';
        return text.replace(/\n/g, '<br>');
    }
  }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap');

.vivu-chatbot-wrapper {
  font-family: 'Be Vietnam Pro', sans-serif;
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 999999; 
  display: flex;
  flex-direction: column;
  align-items: flex-end; 
}

/* ── NÚT BONG BÓNG ── */
.vivu-toggle-btn {
  width: 55px;
  height: 55px;
  border-radius: 50%;
  background: linear-gradient(135deg, #0d7a5f, #10b981);
  color: white;
  font-size: 24px;
  border: none;
  cursor: pointer;
  box-shadow: 0 4px 15px rgba(13, 122, 95, 0.4);
  margin-top: 15px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
}
.vivu-toggle-btn:hover {
  transform: translateY(-3px) scale(1.05);
  box-shadow: 0 6px 20px rgba(13, 122, 95, 0.5);
}
.pulse-animation {
    animation: pulse 2s infinite;
}
@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(13, 122, 95, 0.4); }
    70% { box-shadow: 0 0 0 15px rgba(13, 122, 95, 0); }
    100% { box-shadow: 0 0 0 0 rgba(13, 122, 95, 0); }
}

/* ── CỬA SỔ CHAT ── */
.vivu-chat-container {
  width: 360px;
  height: 500px; /* Cố định chiều cao */
  border-radius: 16px;
  background: #ffffff;
  display: flex;
  flex-direction: column;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); 
  overflow: hidden;
  border: 1px solid #f0f0f0;
}

/* ── HEADER ── */
.vivu-chat-header {
  background: linear-gradient(90deg, #0d7a5f, #10b981);
  padding: 12px 16px;
  display: flex;
  justify-content: space-between; 
  align-items: center;
}
.bot-avatar {
    width: 38px;
    height: 38px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
}
.vivu-close-btn {
  background: rgba(255, 255, 255, 0.2);
  border: none;
  width: 30px;
  height: 30px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  color: white;
  transition: 0.2s;
}
.vivu-close-btn:hover {
  background: rgba(255, 255, 255, 0.4);
}

/* ── KHU VỰC TIN NHẮN ── */
.vivu-chat-messages {
  flex: 1; /* Chiếm phần còn lại */
  overflow-y: auto;
  padding: 16px;
  background: #f8fafc; /* Màu xám rất nhẹ */
  scroll-behavior: smooth;
}
.vivu-chat-messages::-webkit-scrollbar {
  width: 5px;
}
.vivu-chat-messages::-webkit-scrollbar-thumb {
  background-color: #cbd5e1;
  border-radius: 10px;
}

.message-row {
  display: flex;
  margin-bottom: 12px;
  align-items: flex-end;
}
.message-row.user {
  justify-content: flex-end;
}
.message-row.bot {
  justify-content: flex-start;
}

.avatar-small {
    width: 28px;
    height: 28px;
    background: #0d7a5f;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    margin-right: 8px;
    flex-shrink: 0;
}

/* Bong bóng chat */
.message-bubble {
  max-width: 75%;
  padding: 10px 14px;
  border-radius: 16px;
  font-size: 14px;
  line-height: 1.5;
  word-wrap: break-word;
}
.user .message-bubble {
  background: #0d7a5f;
  color: white;
  border-bottom-right-radius: 4px; /* Vát nhọn góc dưới phải */
  box-shadow: 0 2px 5px rgba(13, 122, 95, 0.2);
}
.bot .message-bubble {
  background: #ffffff;
  color: #334155;
  border: 1px solid #e2e8f0;
  border-bottom-left-radius: 4px; /* Vát nhọn góc dưới trái */
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}

/* ── HIỆU ỨNG GÕ CHỮ ── */
.typing-indicator span {
  display: inline-block;
  width: 6px;
  height: 6px;
  background-color: #94a3b8;
  border-radius: 50%;
  margin: 0 2px;
  animation: typing 1.4s infinite ease-in-out both;
}
.typing-indicator span:nth-child(1) { animation-delay: -0.32s; }
.typing-indicator span:nth-child(2) { animation-delay: -0.16s; }
@keyframes typing {
  0%, 80%, 100% { transform: scale(0); }
  40% { transform: scale(1); }
}

/* ── KHUNG NHẬP LIỆU ── */
.vivu-chat-input {
  display: flex;
  padding: 12px;
  background: #fff;
  border-top: 1px solid #f0f0f0;
  align-items: center;
}
.vivu-chat-input input {
  flex: 1;
  padding: 10px 16px;
  border: 1px solid #e2e8f0;
  background-color: #f8fafc;
  border-radius: 20px;
  margin-right: 10px;
  outline: none;
  font-size: 14px;
  transition: 0.2s;
}
.vivu-chat-input input:focus {
  border-color: #0d7a5f;
  background-color: #fff;
}
.send-btn {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  cursor: pointer;
  background: #0d7a5f;
  color: white;
  border: none;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: 0.2s;
}
.send-btn:hover:not(:disabled) {
  background: #0a5f4a;
  transform: rotate(15deg);
}
.send-btn:disabled {
  background: #cbd5e1;
  cursor: not-allowed;
}
.font-11 { font-size: 11px;}
</style>