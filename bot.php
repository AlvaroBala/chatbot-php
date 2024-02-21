<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual Assistant</title>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
</head>
<body>
<button id="toggle-chatbot" class="open-chatbot-btn">Chat with Us!</button>
    <div class="chatbot-wrapper">
        <div class="chat-header">
            <div class="title">Virtual Assistant</div>
            <button id="close-chatbot" class="close-btn">&#10005;</button>
        </div>
        <div class="form">
            <div class="inbox bot-inbox">
                <div class="msg-header">
                    <p>Hello there, how can I help you?</p>
                </div>
            </div>
        </div>
        <div class="typing-field">
            <div class="input-data">
                <input id="data" type="text" placeholder="Type something here.." required>
                <button id="send-btn">Send</button>
            </div>
        </div>
    </div>
<script src="chatbot.js"></script>
<script src="script.js"></script>

</body>
</html> 
