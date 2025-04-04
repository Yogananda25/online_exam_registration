<?php
session_start();

// Replace with your database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exam_registration_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Replace with your actual query and table structure
    $sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Successful login
        header("Location: dashboard.htm");
        exit();
    } else {
        // Invalid credentials
        echo "Invalid username or password.";
    }
}

$conn->close();
?>