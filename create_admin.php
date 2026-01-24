<?php
include 'db_connect.php';

$username = "admin"; // you can change this
$hashedPassword = password_hash("admin123", PASSWORD_DEFAULT); // secure password

$sql = "INSERT INTO admin_users (username, password) VALUES ('$username', '$hashedPassword')";
if ($conn->query($sql) === TRUE) {
    echo "✅ Admin user created successfully!";
} else {
    echo "❌ Error: " . $conn->error;
}

$conn->close();
?>
