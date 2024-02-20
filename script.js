$(document).ready(function() {
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
