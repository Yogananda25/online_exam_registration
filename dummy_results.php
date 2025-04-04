<?php
// dummy_backend.php

session_start();

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit();
}

// Simulate fetching results from a database
$results = [
    ['subject' => 'Math', 'score' => 85, 'grade' => 'A'],
    ['subject' => 'Science', 'score' => 78, 'grade' => 'B'],
    ['subject' => 'History', 'score' => 92, 'grade' => 'A'],
    ['subject' => 'English', 'score' => 88, 'grade' => 'A'],
    ['subject' => 'Art', 'score' => 74, 'grade' => 'C'],
];

// Return results as JSON
echo json_encode($results);
?>