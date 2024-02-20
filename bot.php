<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual Assistant</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <div class="title">virtual Assistant</div>
        <div class="form">
            <div class="bot-inbox inbox">
                <div class="icon">
                    <!-- Icon can be placed here if needed -->
                </div>
                <div class="msg-header">
                    <p style="overflow-wrap: break-word; word-break: break-word;">Hello there, how can I help you?</p>
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

    <script>
        // jQuery ready function
        $(document).ready(function(){
            // Click event for send button
            $("#send-btn").on("click", function(){
                sendMessage();
            });

            // Keypress event to trigger sendMessage on Enter key
            $("#data").on("keypress", function(e) {
                if (e.which == 13) {
                    sendMessage();
                }
            });

            // sendMessage function to handle sending and receiving messages
            function sendMessage() {
                let value = $("#data").val();
                let msg = '<div class="user-inbox inbox"><div class="msg-header"><p style="overflow-wrap: break-word; word-break: break-word;">'+ value +'</p></div></div>';
                $(".form").append(msg);
                $("#data").val('');

                // AJAX call to send the message and get a response
                $.ajax({
                    url: 'message.php',
                    type: 'POST',
                    data: 'text='+value,
                    success: function(result){
                        let reply = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p style="overflow-wrap: break-word; word-break: break-word;">'+ result +'</p></div></div>';
                        $(".form").append(reply);
                        // Scroll to the bottom of the form to show new message
                        $(".form").scrollTop($(".form")[0].scrollHeight);
                    }
                });
            }
        });
    </script>
</body>
</html>
