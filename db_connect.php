<?php
$host = "localhost";   // WAMP server runs on localhost
$user = "root";        // default WAMP MySQL username
$pass = "";            // default WAMP MySQL password is empty unless you set one
$dbname = "college_db"; // your phpMyAdmin database name

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully"; // Uncomment to test
?>


