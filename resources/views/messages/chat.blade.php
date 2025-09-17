@extends('layouts.chat')

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
                    <span class="contact-name">{{ $contactName }}</span>
                    @if($itemTitle && $itemTitle !== 'Razmena')
                        <div class="ad-title">{{ $itemTitle }}</div>
                    @elseif($itemTitle === 'Razmena')
                        <div class="ad-title">Razmena proizvoda</div>
                    @endif
                </div>
            </div>
        </div>
        
        @if($itemTitle && $itemTitle !== 'Razmena')
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
                    <span class="item-title">{{ $itemTitle }}</span>
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
        @endif
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
                {{-- <p>Nema poruka u ovoj konverzaciji.</p> --}}
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
    min-height: calc(100vh - 120px);
    height: calc(100vh - 120px);
    color: #333333;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    padding: 0;
    margin: 0;
    border-radius: 0;
    display: flex;
    flex-direction: column;
    box-shadow: none;
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
    background-color: #f8f9fa;
    padding: 4px 8px;
    border-radius: 4px;
    border-left: 3px solid #007bff;
    display: inline-block;
    margin-top: 2px;
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
    height: calc(100vh - 300px);
    border-radius: 0;
    margin: 0;
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
        margin: 0;
        padding: 0;
        min-height: calc(100vh - 100px);
        height: calc(100vh - 100px);
    }
    
    .chat-messages {
        height: calc(100vh - 250px);
        padding: 15px;
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
    const sendButton = document.querySelector('.send-button');
    const otherUserId = '{{ $otherUser->id ?? "" }}';
    let isSending = false;
    
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
    
    // Send button click
    sendButton.addEventListener('click', sendMessage);
    
    function sendMessage() {
        const messageText = messageInput.value.trim();
        
        if (!messageText || isSending) {
            return;
        }
        
        isSending = true;
        sendButton.disabled = true;
        sendButton.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i><span>Šalje...</span>';
        
        // Add message to chat immediately for better UX
        addMessageToChat(messageText, true);
        const tempMessageText = messageText;
        messageInput.value = '';
        messageInput.style.height = 'auto';
        
        // Send message via AJAX
        const formData = new FormData();
        formData.append('message', tempMessageText);
        formData.append('receiver_id', otherUserId);
        formData.append('offer_id', '{{ $offerId ?? "" }}');
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        
        fetch('/messages', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Message was sent successfully, update the message with server data if needed
                console.log('Message sent successfully');
            } else {
                // Remove the message if sending failed
                const lastMessage = chatMessages.querySelector('.message.sent:last-child');
                if (lastMessage) {
                    lastMessage.remove();
                }
                toastr.error('Greška pri slanju poruke: ' + (data.message || 'Nepoznata greška'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Remove the message if sending failed
            const lastMessage = chatMessages.querySelector('.message.sent:last-child');
            if (lastMessage) {
                lastMessage.remove();
            }
            toastr.error('Greška pri slanju poruke');
        })
        .finally(() => {
            isSending = false;
            sendButton.disabled = false;
            sendButton.innerHTML = '<i class="bx bx-send"></i><span>Pošalji</span>';
        });
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
        `;
        
        chatMessages.appendChild(messageDiv);
        scrollToBottom();
    }
    
    // Auto-refresh messages every 5 seconds
    setInterval(function() {
        refreshMessages();
    }, 5000);
    
    function refreshMessages() {
        fetch(`/messages/{{ $otherUser->id ?? "" }}/{{ $offerId ?? "" }}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.messages) {
                updateMessages(data.messages);
            }
        })
        .catch(error => {
            console.error('Error refreshing messages:', error);
        });
    }
    
    function updateMessages(messages) {
        const currentMessageCount = chatMessages.querySelectorAll('.message').length;
        
        if (messages.length > currentMessageCount) {
            // Add new messages
            for (let i = currentMessageCount; i < messages.length; i++) {
                const message = messages[i];
                addMessageToChat(message.message, message.sender_id == '{{ auth()->id() }}');
            }
        }
    }
});
</script>
@endsection
