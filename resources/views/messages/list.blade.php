@extends('layouts.master')

@section('content')
<div class="messages-container">
    <!-- Header -->
    <div class="messages-header">
        <div class="d-flex align-items-center justify-content-between">
            <a href="/dashboard" class="btn btn-outline-light btn-sm">
                <i class="bx bx-arrow-back"></i> Nazad
            </a>
            <h1 class="mb-0">Poruke</h1>
            <div></div> <!-- Spacer for centering -->
        </div>
    </div>

    <!-- Messages List -->
    <div class="messages-list">
        @foreach($messages as $index => $message)
        <div class="message-item-wrapper {{ $message['has_unread'] ? 'has-unread' : '' }}">
            <a href="/messages/{{ $message['conversation_id'] ?? $index + 1 }}/{{ $message['offer_id'] ?? '' }}" class="message-item-link">
                <div class="message-item">
                    <div class="message-content">
                        <div class="message-header">
                            <div class="sender-info">
                                <span class="sender-name">{{ $message['sender_name'] }}</span>
                                @if($message['ad_title'] && $message['ad_title'] !== 'Razmena')
                                    <div class="ad-title">{{ $message['ad_title'] }}</div>
                                @elseif($message['ad_title'] === 'Razmena')
                                    <div class="ad-title">Razmena proizvoda</div>
                                @endif
                                @if($message['is_blocked'])
                                    <span class="blocked-status">Blokiran od strane admina.</span>
                                @endif
                            </div>
                            <div class="message-time">{{ $message['time'] }}</div>
                        </div>
                        <div class="message-subject">{{ $message['subject'] }}</div>
                        @if($message['has_unread'])
                            <div class="unread-indicator">
                                <span class="unread-badge">{{ $message['unread_count'] }}</span>
                                <span class="unread-text">nepročitane poruke</span>
                            </div>
                        @endif
                    </div>
                    <div class="message-actions">
                        @if($message['has_unread'])
                            <button class="mark-read-btn" 
                                    data-conversation-id="{{ $message['conversation_id'] }}" 
                                    data-offer-id="{{ $message['offer_id'] }}" 
                                    title="Označi kao pročitano">
                                <i class="bx bx-check"></i>
                            </button>
                        @endif
                        <button class="delete-conversation-btn" data-conversation-id="{{ $message['conversation_id'] }}" title="Obriši razgovor">
                            <i class="bx bx-trash"></i>
                        </button>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

<style>
.messages-container {
    background-color: #ffffff;
    min-height: calc(100vh - 200px);
    color: #333333;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    padding: 20px;
    margin: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.messages-header {
    text-align: center;
    padding: 20px 0;
    border-bottom: 1px solid #e0e0e0;
}

.messages-header h1 {
    color: #333333;
    font-size: 24px;
    font-weight: bold;
    margin: 0;
}

.filter-section {
    padding: 20px;
    border-bottom: 1px solid #e0e0e0;
}

.filter-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.filter-dropdowns {
    display: flex;
    gap: 10px;
}

.filter-select {
    background-color: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 6px;
    color: #333333;
    padding: 8px 12px;
    font-size: 14px;
    min-width: 120px;
    cursor: pointer;
}

.filter-select.active {
    border-color: #007bff;
}

.filter-select:focus {
    outline: none;
    border-color: #007bff;
}

.filter-checkboxes {
    display: flex;
    gap: 20px;
}

.checkbox-label {
    display: flex;
    align-items: center;
    cursor: pointer;
    font-size: 14px;
    color: #666666;
}

.checkbox-label input[type="checkbox"] {
    display: none;
}

.checkmark {
    width: 16px;
    height: 16px;
    border: 2px solid #ddd;
    border-radius: 3px;
    margin-right: 8px;
    position: relative;
    background-color: #f8f9fa;
}

.checkbox-label input[type="checkbox"]:checked + .checkmark {
    background-color: #007bff;
    border-color: #007bff;
}

.checkbox-label input[type="checkbox"]:checked + .checkmark::after {
    content: '✓';
    position: absolute;
    top: -2px;
    left: 2px;
    color: white;
    font-size: 12px;
    font-weight: bold;
}

.display-options {
    display: flex;
    align-items: center;
    gap: 10px;
}

.display-label {
    color: #666666;
    font-size: 14px;
}

.display-select {
    background-color: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 6px;
    color: #333333;
    padding: 6px 10px;
    font-size: 14px;
    cursor: pointer;
}

.messages-list {
    padding: 0;
    max-height: 60vh;
    overflow-y: auto;
}

.message-item-link {
    text-decoration: none;
    color: inherit;
    display: block;
}

.message-item {
    display: flex;
    align-items: flex-start;
    padding: 15px 0;
    border-bottom: 1px solid #e0e0e0;
    cursor: pointer;
    transition: background-color 0.2s;
}

.message-item:hover {
    background-color: #f8f9fa;
}

/* Unread message styling */
.message-item-wrapper.has-unread .message-item {
    background: linear-gradient(90deg, rgba(0, 123, 255, 0.05) 0%, #ffffff 100%);
    border-left: 4px solid #007bff;
}

.unread-indicator {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 8px;
}

.unread-badge {
    background: linear-gradient(45deg, #ff6b6b, #ee5a24);
    color: white;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    font-size: 12px;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 8px rgba(255, 107, 107, 0.3);
    animation: pulse 2s infinite;
}

.unread-text {
    font-size: 12px;
    color: #dc3545;
    font-weight: 500;
}

/* Mark as read button */
.mark-read-btn {
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
    border: none;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-right: 8px;
    box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
}

.mark-read-btn:hover {
    background: linear-gradient(45deg, #218838, #1e7e34);
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4);
}

.mark-read-btn:active {
    transform: scale(0.95);
}

.mark-read-btn i {
    font-size: 16px;
}

/* Animation for unread badge */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.message-checkbox {
    margin-right: 15px;
    margin-top: 5px;
}

.message-checkbox input[type="checkbox"] {
    width: 16px;
    height: 16px;
    cursor: pointer;
}

.message-content {
    flex: 1;
    min-width: 0;
}

.message-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 5px;
}

.sender-name {
    font-weight: 600;
    color: #333333;
    font-size: 15px;
}

.ad-title {
    color: #007bff;
    font-size: 13px;
    font-weight: 500;
    margin-top: 4px;
    opacity: 0.9;
    background-color: #f8f9fa;
    padding: 4px 8px;
    border-radius: 4px;
    border-left: 3px solid #007bff;
    display: inline-block;
}

.blocked-status {
    color: #ff4444;
    font-size: 12px;
    display: block;
    margin-top: 2px;
}

.message-time {
    color: #888;
    font-size: 12px;
    white-space: nowrap;
}

.message-subject {
    color: #333333;
    font-weight: 500;
    margin-bottom: 5px;
    font-size: 14px;
}

.message-preview {
    color: #666666;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.read-icon {
    color: #007bff;
    font-size: 14px;
}

.message-actions {
    margin-left: 15px;
    margin-top: 5px;
}

.star-icon {
    color: #666;
    font-size: 18px;
    cursor: pointer;
    transition: color 0.2s;
}

.star-icon:hover {
    color: #ffd700;
}

.delete-conversation-btn {
    background: none;
    border: none;
    color: #dc3545;
    font-size: 16px;
    cursor: pointer;
    padding: 5px;
    border-radius: 4px;
    transition: all 0.2s;
    margin-left: 10px;
}

.delete-conversation-btn:hover {
    background-color: #dc3545;
    color: #ffffff;
}

/* Responsive Design */
@media (max-width: 768px) {
    .messages-container {
        margin: 10px;
        padding: 15px;
        min-height: calc(100vh - 150px);
    }
    
    .filter-row {
        flex-direction: column;
        gap: 15px;
        align-items: stretch;
    }
    
    .filter-dropdowns {
        justify-content: center;
    }
    
    .filter-checkboxes {
        justify-content: center;
    }
    
    .message-item {
        padding: 12px 0;
    }
    
    .message-header {
        flex-direction: column;
        gap: 5px;
    }
    
    .message-time {
        align-self: flex-start;
    }
    
    .ad-title {
        font-size: 12px;
    }
}

/* Very small screens */
@media (max-height: 600px) {
    .messages-header {
        padding: 10px 0;
    }
    
    .filter-section {
        padding: 10px 20px;
    }
}

/* Large screens */
@media (min-height: 900px) {
    .messages-container {
        max-height: 100vh;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle mark as read button clicks
    document.querySelectorAll('.mark-read-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const conversationId = this.getAttribute('data-conversation-id');
            const offerId = this.getAttribute('data-offer-id');
            
            // Show loading state
            const originalContent = this.innerHTML;
            this.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i>';
            this.disabled = true;
            
            fetch('/messages/mark-conversation-read', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    conversation_id: conversationId,
                    offer_id: offerId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove unread indicators
                    const messageWrapper = this.closest('.message-item-wrapper');
                    const unreadIndicator = messageWrapper.querySelector('.unread-indicator');
                    
                    if (unreadIndicator) {
                        unreadIndicator.remove();
                    }
                    
                    // Remove unread styling
                    messageWrapper.classList.remove('has-unread');
                    
                    // Remove mark as read button
                    this.remove();
                    
                    // Show success message
                    if (typeof toastr !== 'undefined') {
                        toastr.success('Poruke su označene kao pročitane');
                    }
                } else {
                    // Restore button state on error
                    this.innerHTML = originalContent;
                    this.disabled = false;
                    
                    if (typeof toastr !== 'undefined') {
                        toastr.error('Greška pri označavanju poruka');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                
                // Restore button state on error
                this.innerHTML = originalContent;
                this.disabled = false;
                
                if (typeof toastr !== 'undefined') {
                    toastr.error('Greška pri označavanju poruka');
                }
            });
        });
    });

    // Handle delete conversation button clicks
    document.querySelectorAll('.delete-conversation-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const conversationId = this.getAttribute('data-conversation-id');
            const messageItem = this.closest('.message-item');
            
            // Show SweetAlert confirmation dialog
            Swal.fire({
                title: 'Obriši razgovor',
                text: 'Da li ste sigurni da želite da obrišete ovaj razgovor? Ova akcija se ne može poništiti.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Da, obriši!',
                cancelButtonText: 'Otkaži'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send delete request
                    fetch(`/messages/delete-conversation/${conversationId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Remove the message item from the list
                            messageItem.parentElement.remove();
                            
                            // Show success message with SweetAlert
                            Swal.fire({
                                title: 'Uspešno!',
                                text: 'Razgovor je uspešno obrisan.',
                                icon: 'success',
                                confirmButtonColor: '#007bff'
                            });
                        } else {
                            // Show error message with SweetAlert
                            Swal.fire({
                                title: 'Greška!',
                                text: data.message || 'Nepoznata greška pri brisanju razgovora.',
                                icon: 'error',
                                confirmButtonColor: '#dc3545'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Show error message with SweetAlert
                        Swal.fire({
                            title: 'Greška!',
                            text: 'Greška pri brisanju razgovora. Molimo pokušajte ponovo.',
                            icon: 'error',
                            confirmButtonColor: '#dc3545'
                        });
                    });
                }
            });
        });
    });
});
</script>
@endsection
