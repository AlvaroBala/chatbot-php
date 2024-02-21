<?php
// nltk_integration.php

function analyzeTextWithNLTK($text) {
    $command = escapeshellcmd("python3 /c/xampp/htdocs/chatbot/chatbot/nltk_processor.py " . escapeshellarg($text));
    exec($command, $output, $return_var);

    if ($return_var != 0) {
        // Handle errors appropriately
        error_log("Error executing NLTK analysis: return_var={$return_var}");
        return null;  // Or consider a default response
    }

    return json_decode(implode("\n", $output), true);
}
