<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit();
}

// Simulate payment processing
$paymentSuccess = true; // Simulate a successful payment

if ($paymentSuccess) {
    // Redirect to the dashboard with a success message
    $_SESSION['payment_status'] = 'success';
    header("Location: dashboard.htm");
    exit();
} else {
    // Redirect to the dashboard with a failure message
    $_SESSION['payment_status'] = 'failure';
    header("Location: dashboard.htm");
    exit();
}
?>