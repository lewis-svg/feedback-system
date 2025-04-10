<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = mysqli_real_escape_string($conn, $_POST["name"]);
    $message = mysqli_real_escape_string($conn, $_POST["message"]);
    $sql = "INSERT INTO feedback (name, message, created_at) VALUES ('$name', '$message', NOW())";
    mysqli_query($conn, $sql);
    header("Location: welcome.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Leave Feedback</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Leave Feedback</h2>
    <form method="post">
        <input type="text" name="name" placeholder="Your Name" required><br>
        <textarea name="message" placeholder="Your Feedback" required></textarea><br>
        <button type="submit">Submit</button>
    </form>
    <br>
    <a href="welcome.php">&#8592; Back to Feedback</a>
</body>
</html>

