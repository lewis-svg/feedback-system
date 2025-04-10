<?php
// Enable error reporting (only for development)
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("db_connect.php");

// Redirect if not logged in
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize inputs
    $username = mysqli_real_escape_string($conn, $_POST["name"]);
    $feedback = mysqli_real_escape_string($conn, $_POST["message"]);

    // Prepare SQL query (column names must match your table: username, feedback)
    $sql = "INSERT INTO feedback (username, feedback, created_at) VALUES ('$username', '$feedback', NOW())";

    // Execute query and redirect or show error
    if (mysqli_query($conn, $sql)) {
        header("Location: welcome.php");
        exit();
    } else {
        echo "Error submitting feedback: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leave Feedback</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
        }
        .container {
            max-width: 500px;
            margin: auto;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
        a {
            display: inline-block;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Leave Feedback</h2>
        <form method="post">
            <input type="text" name="name" placeholder="Your Name" required><br><br>
            <textarea name="message" placeholder="Your Feedback" rows="6" required></textarea><br><br>
            <button type="submit">Submit</button>
        </form>
        <a href="welcome.php">&#8592; Back to Feedback</a>
    </div>
</body>
</html>

