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
        <a href="/messages/{{ $message['conversation_id'] ?? $index + 1 }}" class="message-item-link">
            <div class="message-item">
                <div class="message-content">
                    <div class="message-header">
                        <div class="sender-info">
                            <span class="sender-name">{{ $message['sender_name'] }}</span>
                            <div class="ad-title">{{ $message['ad_title'] }}</div>
                            @if($message['is_blocked'])
                                <span class="blocked-status">Blokiran od strane admina.</span>
                            @endif
                        </div>
                        <div class="message-time">{{ $message['time'] }}</div>
                    </div>
                    <div class="message-subject">{{ $message['subject'] }}</div>
                    <div class="message-preview">
                        @if($message['is_read'])
                            <i class="bx bx-check-double read-icon"></i>
                        @endif
                        {{ $message['preview'] }}
                    </div>
                </div>
                <div class="message-actions">
                    <i class="bx bx-star star-icon"></i>
                </div>
            </div>
        </a>
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
    margin-top: 2px;
    opacity: 0.9;
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
@endsection
