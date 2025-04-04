<?php
session_start(); // Start the session

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$con = mysqli_connect('localhost', 'root', '', 'exam_registration_db');

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Prepare and bind
$stmt = $con->prepare("INSERT INTO registrations (name, email, phone, gender, address, pincode, city, state, county, caste, exam, qualification, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    die("Prepare failed: " . $con->error);
}

$stmt->bind_param("sssssssssssss", $name, $email, $phone, $gender, $address, $pincode, $city, $state, $county, $caste, $exam, $qualification, $date);

// Set parameters
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$gender = $_POST['gender'] ?? '';
$address = $_POST['address'] ?? '';
$pincode = $_POST['pincode'] ?? '';
$city = $_POST['city'] ?? '';
$state = $_POST['state'] ?? '';
$county = $_POST['county'] ?? '';
$caste = $_POST['caste'] ?? '';
$exam = $_POST['exam'] ?? '';
$qualification = $_POST['qualification'] ?? '';
$date = $_POST['date'] ?? '';

// Execute the statement
if ($stmt->execute()) {
    // Store necessary details in session for payment
    $_SESSION['payment_details'] = [
        'name' => $name,
        'email' => $email,
        'exam' => $exam
    ];
    
    // Redirect to payment page
    header("Location: payment_form.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$con->close();
?>