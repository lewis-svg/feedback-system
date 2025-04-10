<?php
$server = $_SERVER['SERVER_NAME'];

// ✅ Default to InfinityFree values
$host = "sql302.infinityfree.com"; // your real InfinityFree host
$user = "if0_38709216";           // your InfinityFree username
$pass = "001happylad"; // your InfinityFree DB password
$db   = "if0_38709216_user_db";   // your InfinityFree database name

// ✅ If running locally (Laragon), override with local DB credentials
if ($server === "localhost" || $server === "127.0.0.1" || str_contains($server, ".test")) {
    $host = "localhost";
    $user = "root";
    $pass = "happy";
    $db   = "user_db"; // your local database name
}

$conn = mysqli_connect($host, $user, $pass, $db);

// 🧪 Show connection errors if any
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>


