<?php
session_start(); // Start the session

// Check if payment details are set
if (!isset($_SESSION['payment_details'])) {
    echo "No payment details found.";
    exit();
}
sleep(5);
// Simulate payment processing
echo "Payment processed successfully for you will redirected shortly wait fro few seconds" . htmlspecialchars($_SESSION['payment_details']['name'] );

header('location:dashboard.htm');
// Clear session data
session_unset();
session_destroy();
?>
