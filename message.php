<?php
// Load spaCy model
require_once 'vendor/autoload.php';
use Spacy\Nlp;

$nlp = new Nlp();
$nlp->load('en_core_web_sm');

// Connecting to the database
$conn = mysqli_connect("localhost", "root", "", "bot") or die("Database Error");

// Getting user message through AJAX and sanitizing input
$getMesg = mysqli_real_escape_string($conn, $_POST['text']);

// Preprocess user input using spaCy
$doc = $nlp->process($getMesg);

// Extract normalized text from spaCy document
$processedText = $doc->text;

// Query to fetch bot response based on keyword matching
$query = "SELECT replies FROM chatbot WHERE '$processedText' LIKE CONCAT('%', keywords, '%')";
$result = mysqli_query($conn, $query);

// If match found based on keywords, send the response back to the user; otherwise, send a default message
if(mysqli_num_rows($result) > 0){
    // Fetching reply from the database based on keyword match
    $fetch_data = mysqli_fetch_assoc($result);
    // Storing reply to a variable which we'll send to AJAX
    $reply = $fetch_data['replies'];
    echo $reply;
} else {
    echo "Sorry, I didn't understand your query!";
}

// Closing the database connection
mysqli_close($conn);
?>
