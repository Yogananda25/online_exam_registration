<?php
session_start();
require 'db_connect.php';

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit();
}

// Get the logged-in user's email
$email = $_SESSION['email']; // Assuming email is stored in session

// Fetch user ID from the database
$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "You are not registered. Please check your email.";
    exit();
}

$user_id = $user['id'];

// Fetch results for the logged-in user
$semester = $_GET['semester'] ?? null;
$stmt = $pdo->prepare("SELECT subject, score, grade FROM results WHERE user_id = ? AND semester = ?");
$stmt->execute([$user_id, $semester]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports & Analysis</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 {
            color: #00796b;
            margin-bottom: 20px;
        }
        .chart-container {
            width: 80%;
            max-width: 600px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }
        canvas {
            max-width: 100%;
        }
    </style>
</head>
<body>
    <h1>Reports & Analysis</h1>
    <div class="chart-container">
        <canvas id="resultsChart"></canvas>
    </div>

    <script>
    // Prepare data for the chart
    const results = <?php echo json_encode($results); ?>;
    const labels = results.map(result => result.subject);
    const scores = results.map(result => result.score);

    // Render the chart
    const ctx = document.getElementById('resultsChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Scores',
                data: scores,
                backgroundColor: 'rgba(0, 123, 255, 0.5)',
                borderColor: 'rgba(0, 123, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
</body>
</html>