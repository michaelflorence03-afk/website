<?php
session_start();
include 'db_connect.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin_users WHERE username='$username' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['admin'] = $username;
            header("Location: dashboard_home.php");
            exit;
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f0f2f5; }
    .container {
      width: 400px; margin: 100px auto; background: white; padding: 25px;
      border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
    h2 { text-align: center; margin-bottom: 20px; }
    .error { color: red; text-align: center; margin-bottom: 15px; }
    input {
      width: 50%; padding: 12px; margin: 8px 0;
      border: 1px solid #ccc; border-radius: 4px;
    }
    button {
      width: 50%; padding: 12px; background: #4CAF50; color: white;
      border: none; border-radius: 4px; font-size: 16px; cursor: pointer;
    }
    button:hover { background: #45a049; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Admin Login</h2>
    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="POST" action="login.php">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>
