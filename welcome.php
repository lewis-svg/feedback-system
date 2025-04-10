<?php
session_start();
include("db_connect.php");

// Redirect if not logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT username, feedback, created_at FROM feedback ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?></h2>
    <p>
        <a href="leave_feedback.php">← Leave Feedback</a> |
        <a href="logout.php" class="logout-link">Logout</a>
    </p>

    <h3>Recent Feedback</h3>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='feedback'>";
            echo "<strong>" . htmlspecialchars($row['username']) . ":</strong><br>";
            echo nl2br(htmlspecialchars($row['feedback']));
            echo "<br><em>on " . $row['created_at'] . "</em>";
            echo "</div>";
        }
    } else {
        echo "<p>No feedback yet!</p>";
    }
    ?>
</div>
</body>
</html>
