<?php
include 'db_connect.php';

$response = [
  'applications' => 0,
  'programs' => 0
];

$app = $conn->query("SELECT COUNT(*) AS total FROM admissions");
if ($app && $app->num_rows > 0) {
  $response['applications'] = $app->fetch_assoc()['total'];
}

$prog = $conn->query("SELECT COUNT(*) AS total FROM programs");
if ($prog && $prog->num_rows > 0) {
  $response['programs'] = $prog->fetch_assoc()['total'];
}

echo json_encode($response);
$conn->close();
?>
