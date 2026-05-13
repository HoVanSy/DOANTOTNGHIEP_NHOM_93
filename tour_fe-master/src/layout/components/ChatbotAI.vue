<template>
  <div class="vivu-chatbot-wrapper">
    
    <!-- Chat Container -->
    <transition name="slide-up">
      <div class="vivu-chat-container" v-show="isOpen">
        <!-- Header -->
        <div class="vivu-chat-header">
          <div class="header-info">
            <div class="avatar-wrapper">
              <div class="bot-avatar-circle">
                <i class="fas fa-paper-plane"></i>
              </div>
            </div>
            <div class="header-text">
              <h5 class="mb-0">Vivu Travel</h5>
              <span class="status-text">Trợ lý ảo</span>
            </div>
          </div>
          <button class="vivu-close-btn" @click="toggleChat">
            <i class="fas fa-times"></i>
          </button>
        </div>

        <!-- Messages Area -->
        <div class="vivu-chat-messages" ref="messagesContainer">
          <!-- Welcome Message -->
          <div class="message bot-message">
            <div class="message-avatar">
              <div class="bot-avatar-circle small">
                <i class="fas fa-paper-plane"></i>
              </div>
            </div>
            <div class="message-content">
              <div class="message-bubble bot-bubble">
                <p class="mb-1 fw-bold">Xin chào! 👋</p>
                <p class="mb-1">Tôi là trợ lý ảo của Vivu Travel.</p>
                <p class="mb-0">Tôi có thể giúp bạn tìm kiếm tour du lịch, tư vấn chi tiết và giải đáp mọi thắc mắc!</p>
              </div>
              <span class="message-time">{{ formatTime(new Date()) }}</span>
            </div>
          </div>

          <!-- Chat Messages -->
          <div v-for="message in messages" :key="message.id">
            <!-- User Message -->
            <div v-if="message.sender === 'user'" class="message user-message">
              <div class="message-content justify-content-end">
                <div class="message-bubble user-bubble">
                  <p class="mb-0">{{ message.text }}</p>
                </div>
                <span class="message-time">{{ formatTime(message.time) }}</span>
              </div>
            </div>

            <!-- Bot Message -->
            <div v-else class="message bot-message">
              <div class="message-avatar">
                <div class="bot-avatar-circle small">
                  <i class="fas fa-paper-plane"></i>
                </div>
              </div>
              <div class="message-content">
                <div class="message-bubble bot-bubble">
                  <p class="mb-0">{{ message.text }}</p>
                </div>
                <span class="message-time">{{ formatTime(message.time) }}</span>
              </div>
            </div>
          </div>

          <!-- Typing Indicator -->
          <div v-if="isTyping" class="message bot-message">
            <div class="message-avatar">
              <div class="bot-avatar-circle small">
                <i class="fas fa-paper-plane"></i>
              </div>
            </div>
            <div class="message-content">
              <div class="message-bubble bot-bubble typing-bubble">
                <div class="typing-indicator">
                  <span></span>
                  <span></span>
                  <span></span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Input Area -->
        <div class="vivu-chat-input">
          <div class="input-wrapper">
            <input 
              v-model="userInput" 
              @keypress.enter="sendMessage" 
              placeholder="Nhập tin nhắn..." 
              :disabled="isTyping"
              class="chat-input"
            >
            <button 
              class="send-btn" 
              @click="sendMessage" 
              :disabled="isTyping || !userInput.trim()"
            >
              <i class="fas fa-paper-plane"></i>
            </button>
          </div>
        </div>
      </div>
    </transition>

    <!-- Toggle Button -->
    <transition name="bounce">
      <button class="vivu-toggle-btn" @click="toggleChat">
        <i :class="isOpen ? 'fas fa-times' : 'fas fa-headset'"></i>
        <span v-if="!isOpen" class="notification-badge" v-show="unreadCount > 0">{{ unreadCount }}</span>
      </button>
    </transition>
    
  </div>
</template>

<script>
import chatbotService from '../../core/chatbotService.js';

export default {
  name: 'ChatbotAI',
  data() {
    return {
      isOpen: false, 
      messages: [],
      userInput: '',
      isTyping: false,
      messageId: 1,
      unreadCount: 0
    }
  },
  methods: {
    toggleChat() {
      this.isOpen = !this.isOpen;
      if (this.isOpen) {
        this.unreadCount = 0;
        this.$nextTick(() => {
          this.scrollToBottom();
        });
      }
    },

    async sendMessage() {
      if (!this.userInput.trim() || this.isTyping) return;

      const text = this.userInput.trim();
      const currentTime = new Date();
      
      this.messages.push({ 
        id: this.messageId++, 
        sender: 'user', 
        text: text,
        time: currentTime
      });
      
      this.userInput = '';
      this.isTyping = true;
      this.scrollToBottom();

      try {
        const response = await chatbotService.sendMessage(text);
        
        this.messages.push({ 
          id: this.messageId++, 
          sender: 'bot', 
          text: response.data || response,
          time: new Date()
        });
      } catch (error) {
        this.messages.push({ 
          id: this.messageId++, 
          sender: 'bot', 
          text: 'Xin lỗi, tôi đang gặp sự cố. Vui lòng thử lại sau nhé!',
          time: new Date()
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

    formatTime(date) {
      return date.toLocaleTimeString('vi-VN', { hour: '2-digit', minute: '2-digit' });
    }
  }
}
</script>

<style scoped>
/* ==================== WRAPPER ==================== */
.vivu-chatbot-wrapper {
  position: fixed;
  bottom: 24px;
  right: 24px;
  z-index: 9999;
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 12px;
}

/* ==================== TOGGLE BUTTON ==================== */
.vivu-toggle-btn {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background: linear-gradient(135deg, #FFBD00 0%, #FF9C00 100%);
  color: #003C71;
  font-size: 24px;
  border: none;
  cursor: pointer;
  box-shadow: 0 4px 20px rgba(255, 189, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  transition: all 0.3s ease;
}

.vivu-toggle-btn:hover {
  transform: scale(1.1);
  box-shadow: 0 6px 25px rgba(255, 189, 0, 0.6);
  background: linear-gradient(135deg, #FFC933 0%, #FFAB1A 100%);
}

.notification-badge {
  position: absolute;
  top: -4px;
  right: -4px;
  background: #dc3545;
  color: white;
  font-size: 11px;
  font-weight: bold;
  min-width: 20px;
  height: 20px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  animation: pulse 2s infinite;
}

/* ==================== CHAT CONTAINER ==================== */
.vivu-chat-container {
  width: 380px;
  height: 520px;
  background: #ffffff;
  border-radius: 16px;
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
  display: flex;
  flex-direction: column;
  overflow: hidden;
  border: 2px solid #FFBD00;
}

/* ==================== HEADER ==================== */
.vivu-chat-header {
  background: linear-gradient(135deg, #003C71 0%, #004E8A 100%);
  padding: 16px 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.header-info {
  display: flex;
  align-items: center;
  gap: 12px;
}

.avatar-wrapper {
  position: relative;
}

.bot-avatar-circle {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  background: #FFBD00;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 2px solid rgba(255, 255, 255, 0.3);
}

.bot-avatar-circle i {
  color: #003C71;
  font-size: 18px;
}

.bot-avatar-circle.small {
  width: 36px;
  height: 36px;
}

.bot-avatar-circle.small i {
  font-size: 14px;
}

.header-text h5 {
  color: white;
  font-weight: 600;
  font-size: 16px;
}

.status-text {
  color: rgba(255, 255, 255, 0.8);
  font-size: 12px;
}

.vivu-close-btn {
  background: rgba(255, 255, 255, 0.15);
  border: none;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  color: white;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s ease;
}

.vivu-close-btn:hover {
  background: #FFBD00;
  color: #003C71;
  transform: rotate(90deg);
}

/* ==================== MESSAGES AREA ==================== */
.vivu-chat-messages {
  flex: 1;
  overflow-y: auto;
  padding: 20px;
  background: #f8f9fa;
  display: flex;
  flex-direction: column;
  gap: 16px;
}

/* Custom Scrollbar */
.vivu-chat-messages::-webkit-scrollbar {
  width: 6px;
}

.vivu-chat-messages::-webkit-scrollbar-track {
  background: transparent;
}

.vivu-chat-messages::-webkit-scrollbar-thumb {
  background: #ddd;
  border-radius: 3px;
}

.vivu-chat-messages::-webkit-scrollbar-thumb:hover {
  background: #ccc;
}

/* ==================== MESSAGE STYLES ==================== */
.message {
  display: flex;
  gap: 10px;
  animation: fadeIn 0.3s ease;
}

.user-message {
  flex-direction: row-reverse;
}

.message-avatar {
  flex-shrink: 0;
}

.message-content {
  display: flex;
  flex-direction: column;
  max-width: 80%;
}

.message-bubble {
  padding: 12px 16px;
  border-radius: 16px;
  position: relative;
}

.user-bubble {
  background: linear-gradient(135deg, #003C71 0%, #004E8A 100%);
  color: white;
  border-bottom-right-radius: 4px;
}

.bot-bubble {
  background: white;
  color: #333;
  border-bottom-left-radius: 4px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  border: 1px solid #eee;
}

.message-bubble p {
  font-size: 14px;
  line-height: 1.5;
  margin: 0;
}

.message-time {
  font-size: 11px;
  color: #999;
  margin-top: 4px;
  padding: 0 4px;
}

/* ==================== TYPING INDICATOR ==================== */
.typing-bubble {
  padding: 16px 20px;
}

.typing-indicator {
  display: flex;
  gap: 4px;
}

.typing-indicator span {
  width: 8px;
  height: 8px;
  background: #999;
  border-radius: 50%;
  animation: typing 1.4s infinite ease-in-out;
}

.typing-indicator span:nth-child(1) { animation-delay: 0s; }
.typing-indicator span:nth-child(2) { animation-delay: 0.2s; }
.typing-indicator span:nth-child(3) { animation-delay: 0.4s; }

/* ==================== INPUT AREA ==================== */
.vivu-chat-input {
  padding: 16px 20px;
  background: white;
  border-top: 1px solid #eee;
}

.input-wrapper {
  display: flex;
  gap: 10px;
  align-items: center;
}

.chat-input {
  flex: 1;
  padding: 12px 16px;
  border: 2px solid #e0e0e0;
  border-radius: 24px;
  font-size: 14px;
  outline: none;
  transition: all 0.2s ease;
}

.chat-input:focus {
  border-color: #003C71;
  box-shadow: 0 0 0 3px rgba(0, 60, 113, 0.1);
}

.chat-input::placeholder {
  color: #999;
}

.send-btn {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  background: linear-gradient(135deg, #FFBD00 0%, #FF9C00 100%);
  color: #003C71;
  border: none;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s ease;
}

.send-btn:hover:not(:disabled) {
  transform: scale(1.05);
  box-shadow: 0 4px 15px rgba(255, 189, 0, 0.4);
}

.send-btn:disabled {
  background: #ddd;
  color: #999;
  cursor: not-allowed;
}

/* ==================== ANIMATIONS ==================== */
@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes bounce {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.1); }
}

@keyframes pulse {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.1); }
}

@keyframes typing {
  0%, 60%, 100% { 
    transform: translateY(0);
    opacity: 0.5;
  }
  30% { 
    transform: translateY(-6px);
    opacity: 1;
  }
}

/* Transition */
.slide-up-enter-active {
  animation: slideUp 0.3s ease;
}

.slide-up-leave-active {
  animation: slideUp 0.3s ease reverse;
}

.bounce-enter-active,
.bounce-leave-active {
  transition: all 0.3s ease;
}

.bounce-enter-from,
.bounce-leave-to {
  transform: scale(0);
  opacity: 0;
}

/* ==================== RESPONSIVE ==================== */
@media (max-width: 480px) {
  .vivu-chat-container {
    width: calc(100vw - 32px);
    height: calc(100vh - 120px);
    max-height: 520px;
  }
  
  .vivu-toggle-btn {
    width: 52px;
    height: 52px;
    font-size: 20px;
  }
}
</style>
