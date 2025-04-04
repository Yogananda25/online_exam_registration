<?php
header('Content-Type: application/json');

session_start();

// Connect to the database
$con = new mysqli('localhost', 'root', '', 'exam_registration_db');

// Check connection
if ($con->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit();
}

// Get the email from POST data
$email = $_POST['email'];

// Prepare and execute the query
$stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) { // If user exists
    // Simulate fetching results for the semester
    $results = [
        ['subject' => 'computer networks', 'score' => 85, 'grade' => 'B'],
        ['subject' => 'SEAD', 'score' => 98, 'grade' => 'A'],
        ['subject' => 'OS', 'score' => 86, 'grade' => 'A'],
        ['subject' => 'Gen AI', 'score' => 95, 'grade' => 'A']
    ];
    echo json_encode(['success' => true, 'results' => $results]);
} else {
    echo json_encode(['success' => false, 'message' => 'Results not published for this email.']);
}

// Close the connection
$stmt->close();
$con->close();
?>