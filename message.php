<?php
// connecting to the database
$conn = mysqli_connect("localhost", "root", "", "bot") or die("Database Error");

// getting user message through AJAX
$getMesg = mysqli_real_escape_string($conn, $_POST['text']);

// checking user query against database queries and keywords
$check_data = "SELECT replies FROM chatbot WHERE queries LIKE '%$getMesg%'";

$run_query = mysqli_query($conn, $check_data) or die("Error");

// if no direct match, try matching based on keywords
if(mysqli_num_rows($run_query) == 0) {
    $check_keywords = explode(";", $getMesg); // Assuming keywords are separated by semicolons
    $keywords_condition = "";

    // Constructing the SQL condition to match any keyword
    foreach($check_keywords as $keyword) {
        $keywords_condition .= "keywords LIKE '%$keyword%' OR ";
    }
    $keywords_condition = rtrim($keywords_condition, "OR "); // Remove the last "OR" from the condition

    // Check for matches based on keywords
    $check_data_keywords = "SELECT replies FROM chatbot WHERE $keywords_condition";
    $run_query_keywords = mysqli_query($conn, $check_data_keywords) or die("Error");

    if(mysqli_num_rows($run_query_keywords) > 0) {
        $fetch_data_keywords = mysqli_fetch_assoc($run_query_keywords);
        $replay = $fetch_data_keywords['replies'];
        echo $replay;
    } else {
        echo "Sorry, can't be able to understand you!";
    }
} else {
    $fetch_data = mysqli_fetch_assoc($run_query);
    $replay = $fetch_data['replies'];
    echo $replay;
}


