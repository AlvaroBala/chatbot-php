$(document).ready(function(){
    // Function to handle sending and receiving messages
    function sendMessage() {
        let userInput = $("#data").val();
        if(userInput.trim() !== '') {
            let userMsg = '<div class="inbox user-inbox"><div class="msg-header"><p>'+ userInput +'</p></div></div>';
            $(".form").append(userMsg);
            $("#data").val('');
            $(".form").scrollTop($(".form")[0].scrollHeight);

            // Simulate an AJAX call to server for bot response
            $.ajax({
                url: 'message.php', // Update this URL to the path of your server-side script
                type: 'POST',
                data: {text: userInput},
                success: function(response){
                    let botReply = '<div class="bot-inbox inbox"><div class="msg-header"><p>'+ response +'</p></div></div>';
                    $(".form").append(botReply);
                    $(".form").scrollTop($(".form")[0].scrollHeight);
                },
                error: function() {
                    console.error("Error occurred in sending message");
                }
            });
        }
    }
    
    $("#toggle-chatbot").click(function() {
        $(".chatbot-wrapper").fadeToggle('fast', function() {
            // This line ensures the chat button hides when the chat is visible and vice versa
            $("#toggle-chatbot").css('display', $(".chatbot-wrapper").is(":visible") ? 'none' : 'block');
        });
        $("#data").focus();
    });

    // Close the chatbot and show the 'Chat with Us!' button
    $("#close-chatbot").click(function() {
        $(".chatbot-wrapper").fadeOut('fast', function() {
            $("#toggle-chatbot").css('display', 'block');
        });
    });

    // Event handler for send button click
    $("#send-btn").on("click", sendMessage);

    // Event handler for enter keypress in input field
    $("#data").on("keypress", function(e) {
        if (e.which == 13) {
            sendMessage();
        }
    });

    // Event handler to toggle the chatbot visibility
    $("#toggle-chatbot").click(function() {
        $(".chatbot-wrapper").fadeToggle('fast', function() {
            $("#toggle-chatbot").toggle(!$(".chatbot-wrapper").is(":visible"));
        });
        $("#data").focus();
    });

    // Event handler to close the chatbot and show the 'Chat with Us!' button
    $("#close-chatbot").click(function() {
        $(".chatbot-wrapper").fadeOut('fast', function() {
            $("#toggle-chatbot").show();
        });
    });

    // Function to adjust chat window height to make sure input is always visible
    function adjustChatHeight() {
        var chatWindow = $('.chatbot-wrapper');
        var chatMessages = $('.form');
        var inputHeight = $('.typing-field').outerHeight(true); // true includes margin
        chatMessages.height(chatWindow.height() - inputHeight - $('.chat-header').outerHeight(true));
    }

    // Call adjustChatHeight on window resize and on page load
    $(window).resize(adjustChatHeight);
    adjustChatHeight();
        // Handle the opening and closing of the chatbot
        $("#toggle-chatbot").click(function() {
            $(".chatbot-wrapper").toggle();
        });
    
        $("#close-chatbot").click(function() {
            $(".chatbot-wrapper").hide();
        });
    
        // Handle sending messages
        $("#send-btn").click(function() {
            let userMessage = $("#data").val();
            if(userMessage.trim() != '') {
                $(".form").append('<div class="inbox user-inbox"><div class="msg-header"><p>' + userMessage + '</p></div></div>');
                $("#data").val(''); // Clear the input field
                
                // Scroll to the latest message
                $(".form").scrollTop($(".form")[0].scrollHeight);
            }
        });
    
        // Allow sending messages with the Enter key
        $("#data").keypress(function(e) {
            if(e.which == 13) {
                $("#send-btn").click();
            }
        });
});
