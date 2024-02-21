<?php

$host = 'localhost';
$db = 'bot'; // Replace with your database name
$user = 'root'; // Replace with your database username
$pass = ''; // Replace with your database password
$charset = 'utf8mb4';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Function to call the NLTK Python script
function analyzeTextWithNLTK($text) {
    $command = escapeshellcmd("python3 nltk_processor.py " . escapeshellarg($text));
    exec($command, $output, $return_var);

    if ($return_var != 0) {
        // Handle errors
        return null;
    }

    return json_decode(implode("\n", $output), true);
}

// Function to get the best match based on keyword matches
function getBestMatchedReply($pdo, $userMessage) {
    $keywords = explode(' ', $userMessage);
    $keywords = array_filter($keywords); // Remove any empty elements
    $keywords = array_unique($keywords); // Remove duplicate words to optimize the query
    $regexPattern = implode('|', array_map('preg_quote', $keywords));

    // Prepare the SQL query to count keyword matches
    $stmt = $pdo->prepare("
        SELECT replies
        FROM chatbot
        WHERE queries REGEXP ?
        ORDER BY LENGTH(queries) ASC
        LIMIT 1
    ");

    // Execute the query with the regex pattern as the parameter
    $stmt->execute([$regexPattern]);

    // Fetch the best matched reply
    return $stmt->fetch(PDO::FETCH_ASSOC)['replies'] ?? null;
}

// Assuming the AJAX post sends a 'text' parameter with the user's message
$userMessage = strtolower(trim($_POST['text'])); // Convert to lowercase and trim whitespace

// Check the message against known patterns first
$knownPatterns = [
    '/\b(hi|hello|hey|greetings|welcome|good morning|good afternoon|good evening)\b/' => "Hello, how can I help you?",
    '/\bhow are you\b/' => "Hello, what is your problem?",
    // ... other patterns
];

foreach ($knownPatterns as $pattern => $response) {
    if (preg_match($pattern, $userMessage)) {
        echo $response;
        exit;
    }
}

// Replace the full-text search with the keyword matching function
$reply = getBestMatchedReply($pdo, $userMessage);

// Check if a reply is found
if ($reply) {
    echo $reply;
} else {
    // Use NLTK for additional analysis if no match is found
    $nlpResult = analyzeTextWithNLTK($userMessage);

    // Customize this part based on the NLP result
    if ($nlpResult && $nlpResult['compound'] < 0) {
        echo "It seems like you're having a bad experience. How can I assist you further?";
    } else {
        echo "Sorry, I can't understand that. Can you rephrase?";
    }
}

