<?php
session_start(); // Start the session

// Check if payment details are set
if (!isset($_SESSION['payment_details'])) {
    echo "No payment details found.";
    exit();
}

$details = $_SESSION['payment_details'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Form</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #ffecd2, #fcb69f);
            color: #333;
        }

        .header {
            background-color: #ff6f61;
            color: white;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .container {
            width: 50%;
            margin: 40px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            border-top: 5px solid #ff6f61;
            border-bottom: 5px solid #ff6f61;
        }

        h2 {
            text-align: center;
            color: #ff6f61;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            margin: 10px 0;
        }

        label {
            font-weight: bold;
            color: #555;
            display: block;
            margin-top: 20px;
        }

        input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-top: 5px;
            border: 2px solid #ff6f61;
            border-radius: 5px;
            font-size: 16px;
            background-color: #f9f9f9;
            display: block;
        }

        input[type="submit"] {
            background-color: #ff6f61;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            text-align: center;
            width: 100%;
            padding: 12px;
            font-size: 18px;
            border-radius: 5px;
            margin-top: 30px;
        }

        input[type="submit"]:hover {
            background-color: #ff8a65;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Lumous University - Payment</h1>
    </div>

    <div class="container">
        <h2>Payment Details</h2>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($details['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($details['email']); ?></p>
        <p><strong>Exam:</strong> <?php echo htmlspecialchars($details['exam']); ?></p>

        <form action="process_payment.php" method="POST">
            <label for="amount">Amount:</label>
            <input type="text" id="amount" name="amount" value="100" readonly> <!-- Example amount -->
            <input type="submit" value="Proceed to Pay">
        </form>
    </div>
</body>
</html>