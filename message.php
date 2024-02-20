<?php

$host = 'localhost';
$db   = 'bot'; // Replace with your database name
$user = 'root'; // Replace with your database username
$pass = ''; // Replace with your database password
$charset = 'utf8mb4';

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Assuming the AJAX post sends a 'text' parameter with the user's message
$userMessage = strtolower(trim($_POST['text'])); // Convert to lowercase and trim whitespace

// Manual check for common greetings
$greetings = ['hi', 'hello', 'hey', 'greetings', 'good morning', 'good afternoon', 'good evening'];
if (in_array($userMessage, $greetings)) {
    echo "Hello, how can I help you?";
    exit;
}

// Prepare the full-text search SQL query
$stmt = $pdo->prepare("SELECT replies FROM chatbot WHERE MATCH(queries, keywords) AGAINST(:message IN NATURAL LANGUAGE MODE)");

// Execute the query with the user message as the parameter
$stmt->execute(['message' => $userMessage]);

// Fetch the reply
$reply = $stmt->fetchColumn();

// Check if a reply is found
if ($reply) {
    echo $reply;
} else {
    // No matching keywords found in the database
    echo "Sorry, I can't understand that. Can you rephrase?";
}


