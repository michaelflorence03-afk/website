<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM applications WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php?msg=deleted");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    header("Location: admin.php");
    exit;
}
?>
