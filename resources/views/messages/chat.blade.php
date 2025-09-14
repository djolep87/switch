@extends('layouts.master')

@section('content')
<div class="chat-container">
    <!-- Top Header -->
    <div class="chat-header">
        <div class="header-left">
            <a href="/messages" class="back-button">
                <i class="bx bx-arrow-back"></i>
            </a>
            <span class="header-title">Poruke</span>
        </div>
        {{-- <div class="header-right">
            <i class="bx bx-bell header-icon"></i>
            <i class="bx bx-dots-vertical header-icon"></i>
        </div> --}}
    </div>

    <!-- Contact and Item Information -->
    <div class="contact-section">
        <div class="contact-info">
            <div class="contact-details">
                <i class="bx bx-user contact-icon"></i>
                <div class="contact-name-section">
                    <span class="contact-name">{{ $contactName ?? 'Goran' }}</span>
                    <div class="ad-title">{{ $itemTitle ?? 'Razmena' }}</div>
                </div>
            </div>
        </div>
        
        <div class="item-info">
            <div class="item-image">
                @if($adImage)
                    <img src="{{ asset('storage/Product_images/' . $adImage) }}" alt="{{ $itemTitle }}" class="product-image">
                @else
                    <i class="bx bx-image-slash"></i>
                @endif
            </div>
            <div class="item-details">
                <div class="item-name">
                    <span class="item-title">{{ $itemTitle ?? 'MacBook Pro 15 32GB' }}</span>
                    
                </div>
                <div class="item-meta">
                    
                    {{-- <div class="item-stats">
                        <span class="stat">
                            <i class="bx bx-show"></i>
                            974
                        </span>
                        <span class="stat">
                            <i class="bx bx-star"></i>
                            19
                        </span>
                        <span class="stat-time">pre 10 meseci</span>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Chat Messages Area -->
    <div class="chat-messages" id="chatMessages">
        <!-- Date Separator -->
        <div class="date-separator">
            
        </div>

        <!-- Messages -->
        @if(isset($messages) && $messages->count() > 0)
            @foreach($messages as $message)
                <div class="message {{ $message->sender_id == auth()->id() ? 'sent' : 'received' }}">
                    <div class="message-bubble">
                        <div class="message-text">{{ $message->message }}</div>
                        <div class="message-time">{{ $message->created_at->format('H:i') }}h</div>
                    </div>
                    {{-- @if($message->sender_id != auth()->id())
                        <div class="message-status">
                            <i class="bx bx-check-double"></i>
                        </div>
                    @endif --}}
                </div>
            @endforeach
        @else
            <div class="text-center text-muted mt-5">
                <p>Nema poruka u ovoj konverzaciji.</p>
            </div>
        @endif
    </div>

    <!-- Message Input Area -->
    <div class="message-input-section">
       
        <div class="input-container">
            <textarea 
                class="message-input" 
                placeholder="Unesite Vašu poruku."
                rows="1"
            ></textarea>
            <div class="input-actions-right">
               
                <button class="send-button">
                    <i class="bx bx-send"></i>
                    <span>Pošalji</span>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.chat-container {
    background-color: #ffffff;
    min-height: calc(100vh - 200px);
    color: #333333;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    padding: 20px;
    margin: 20px;
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

/* Header */
.chat-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    border-bottom: 1px solid #e0e0e0;
    background-color: #f8f9fa;
}

.header-left {
    display: flex;
    align-items: center;
    gap: 15px;
}

.back-button {
    color: #333333;
    font-size: 20px;
    text-decoration: none;
    padding: 5px;
}

.header-title {
    font-size: 18px;
    font-weight: 600;
    color: #333333;
}

.header-right {
    display: flex;
    gap: 15px;
}

.header-icon {
    color: #cccccc;
    font-size: 20px;
    cursor: pointer;
}

/* Contact Section */
.contact-section {
    padding: 20px;
    border-bottom: 1px solid #e0e0e0;
    background-color: #f8f9fa;
}

.contact-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.contact-details {
    display: flex;
    align-items: center;
    gap: 10px;
}

.contact-icon {
    color: #666;
    font-size: 18px;
}

.contact-name {
    font-size: 16px;
    font-weight: 600;
    color: #333333;
}

.contact-name-section {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.ad-title {
    color: #007bff;
    font-size: 13px;
    font-weight: 500;
    opacity: 0.9;
}

.contact-actions {
    display: flex;
    align-items: center;
    gap: 15px;
}

.action-button {
    background: none;
    border: none;
    color: #cccccc;
    display: flex;
    align-items: center;
    gap: 5px;
    cursor: pointer;
    font-size: 14px;
    padding: 5px 10px;
    border-radius: 4px;
    transition: background-color 0.2s;
}

.action-button:hover {
    background-color: #333;
}

.action-icon {
    color: #666;
    font-size: 18px;
    cursor: pointer;
}

/* Item Info */
.item-info {
    display: flex;
    align-items: center;
    gap: 15px;
}

.item-image {
    width: 60px;
    height: 60px;
    background-color: #f8f9fa;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #666;
    font-size: 24px;
    overflow: hidden;
}

.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
}

.item-details {
    flex: 1;
}

.item-name {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 5px;
}

.item-title {
    font-size: 16px;
    font-weight: 600;
    color: #333333;
}

.item-status {
    color: #ff4444;
    font-size: 14px;
    font-weight: 600;
}

.item-meta {
    display: flex;
    align-items: center;
    gap: 15px;
}

.item-price {
    color: #ff4444;
    font-size: 16px;
    font-weight: 600;
}

.item-stats {
    display: flex;
    align-items: center;
    gap: 15px;
}

.stat {
    display: flex;
    align-items: center;
    gap: 5px;
    color: #666;
    font-size: 14px;
}

.stat-time {
    color: #666;
    font-size: 14px;
}

/* Chat Messages */
.chat-messages {
    flex: 1;
    padding: 20px;
    background-color: #ffffff;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 15px;
    max-height: 50vh;
    border-radius: 10px;
    margin: 10px 0;
}

.date-separator {
    text-align: center;
    margin: 20px 0;
}

.date-separator span {
    background-color: #333;
    color: #cccccc;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 14px;
}

.message {
    display: flex;
    align-items: flex-end;
    gap: 10px;
}

.message.received {
    justify-content: flex-start;
}

.message.sent {
    justify-content: flex-end;
}

.message-bubble {
    max-width: 70%;
    padding: 12px 16px;
    border-radius: 8px;
    position: relative;
}

.message.received .message-bubble {
    background-color: #f8f9fa;
    color: #333333;
    border: 1px solid #e0e0e0;
}

.message.sent .message-bubble {
    background-color: #007bff;
    color: #ffffff;
}

.message-text {
    font-size: 14px;
    line-height: 1.4;
    margin-bottom: 5px;
}

.message-time {
    font-size: 12px;
    opacity: 0.7;
}

.message-status {
    margin-left: 5px;
    color: #007bff;
    font-size: 14px;
}

/* Message Input */
.message-input-section {
    padding: 20px;
    background-color: #f8f9fa;
    border-top: 1px solid #e0e0e0;
}

.input-actions {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
}

.input-action-btn {
    background: none;
    border: none;
    color: #666;
    display: flex;
    align-items: center;
    gap: 5px;
    cursor: pointer;
    font-size: 14px;
    padding: 8px 12px;
    border-radius: 6px;
    transition: background-color 0.2s;
}

.input-action-btn:hover {
    background-color: #333;
    color: #cccccc;
}

.input-container {
    display: flex;
    align-items: flex-end;
    gap: 10px;
    background-color: #ffffff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 12px;
}

.message-input {
    flex: 1;
    background: none;
    border: none;
    color: #333333;
    font-size: 14px;
    resize: none;
    outline: none;
    min-height: 20px;
    max-height: 100px;
    font-family: inherit;
}

.message-input::placeholder {
    color: #666;
}

.input-actions-right {
    display: flex;
    align-items: center;
    gap: 10px;
}

.send-button {
    background-color: #007bff;
    color: #ffffff;
    border: none;
    padding: 10px 16px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    transition: background-color 0.2s;
}

.send-button:hover {
    background-color: #0056b3;
}

/* Responsive Design */
@media (max-width: 768px) {
    .chat-container {
        margin: 10px;
        padding: 15px;
        min-height: calc(100vh - 150px);
    }
    
    .contact-actions {
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .action-button span {
        display: none;
    }
    
    .item-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
    
    .item-stats {
        gap: 10px;
    }
    
    .input-actions {
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .input-action-btn span {
        display: none;
    }
    
    .send-button span {
        display: none;
    }
}

/* Very small screens */
@media (max-height: 600px) {
    .chat-header {
        padding: 10px 20px;
    }
    
    .contact-section {
        padding: 10px 20px;
    }
    
    .message-input-section {
        padding: 10px 20px;
    }
    
    .chat-messages {
        padding: 10px;
    }
}

/* Large screens */
@media (min-height: 900px) {
    .chat-container {
        max-height: 100vh;
    }
}

/* Ultra-wide screens */
@media (min-width: 1400px) {
    .chat-container {
        max-width: 1200px;
        margin: 0 auto;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const messageInput = document.querySelector('.message-input');
    const chatMessages = document.getElementById('chatMessages');
    
    // Auto-resize textarea
    messageInput.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 100) + 'px';
    });
    
    // Auto-scroll to bottom
    function scrollToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    
    // Initial scroll to bottom
    scrollToBottom();
    
    // Handle Enter key for sending messages
    messageInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });
    
    function sendMessage() {
        const messageText = messageInput.value.trim();
        if (messageText) {
            // Send message via AJAX
            const formData = new FormData();
            formData.append('message', messageText);
            formData.append('receiver_id', '{{ $otherUser->id ?? "" }}');
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            
            fetch('/messages', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    addMessageToChat(messageText, true);
                    messageInput.value = '';
                    messageInput.style.height = 'auto';
                } else {
                    alert('Greška pri slanju poruke: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Greška pri slanju poruke');
            });
        }
    }
    
    function addMessageToChat(text, isSent) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${isSent ? 'sent' : 'received'}`;
        
        const now = new Date();
        const timeString = now.toLocaleTimeString('sr-RS', { 
            hour: '2-digit', 
            minute: '2-digit' 
        });
        
        messageDiv.innerHTML = `
            <div class="message-bubble">
                <div class="message-text">${text}</div>
                <div class="message-time">${timeString}</div>
            </div>
            ${!isSent ? '<div class="message-status"><i class="bx bx-check-double"></i></div>' : ''}
        `;
        
        chatMessages.appendChild(messageDiv);
        scrollToBottom();
    }
    
    // Send button click
    document.querySelector('.send-button').addEventListener('click', sendMessage);
});
</script>
@endsection
