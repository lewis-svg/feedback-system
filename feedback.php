<?php
session_start();
include("connect.php");

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION["email"];
    $feedback = $_POST["feedback"];
    $timestamp = date("Y-m-d H:i:s");

    $query = "INSERT INTO feedback (email, feedback, submitted_at) VALUES ('$email', '$feedback', '$timestamp')";
    mysqli_query($conn, $query);
    $success = "Feedback submitted successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Leave Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }
        .feedback-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            width: 400px;
            text-align: center;
        }
        textarea {
            width: 100%;
            height: 100px;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            resize: none;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="feedback-container">
        <h2>Submit Feedback</h2>
        <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
        <form method="post">
            <textarea name="feedback" placeholder="Your feedback..." required></textarea><br>
            <button type="submit">Send Feedback</button>
        </form>
        <a href="welcome.php">← Back to Home</a>
    </div>
</body>
</html>


