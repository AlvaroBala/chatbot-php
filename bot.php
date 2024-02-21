<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual Assistant</title>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
     <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .open-chatbot-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1001;
            cursor: pointer;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .chatbot-wrapper {
            position: fixed;
            bottom: 0;
            right: 20px;
            z-index: 1000;
            width: 300px;
            height: 400px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            display: none;
            flex-direction: column;
            border-radius: 15px 15px 0 0;
        }
        .chat-header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 15px 15px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .chat-header .title {
            font-size: 18px;
        }
        .close-btn {
            background: none;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
        }
        .form {
            overflow-y: auto;
            flex: 1;
            padding: 10px;
            max-height: calc(100% - 120px);
        }
        .inbox {
            margin: 10px 0;
        }
        .bot-inbox {
            color: #444;
            background-color: #f1f1f1;
            align-self: flex-start;
            margin-right: 25px;
            border-radius: 15px;
        }
        .user-inbox {
            color: white;
            background-color: #007bff;
            align-self: flex-end;
            margin-left: 25px;
            border-radius: 15px;
        }
        .inbox .msg-header {
            padding: 5px 10px;
            border-radius: 15px;
            max-width: 80%;
        }
        .typing-field {
            padding: 10px;
            background-color: #f1f1f1;
            display: flex;
            border-top: 1px solid #ddd;
        }
        .input-data {
            flex: 1;
            display: flex;
        }
        .input-data input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 14px;
        }
        .input-data button {
            padding: 10px 15px;
            margin-left: 5px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
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
