<?php
include 'db_connect.php';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM admissions WHERE id=$id");
    header("Location: admin.php"); // refresh page after delete
    exit;
}

// Handle Search
$search = "";
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $sql = "SELECT * FROM admissions 
            WHERE fullname LIKE '%$search%' 
               OR email LIKE '%$search%' 
               OR phone LIKE '%$search%' 
               OR course LIKE '%$search%'
            ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM admissions ORDER BY id DESC";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel | MyCollege</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* Navbar */
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: #004d40;;
  padding: 15px 30px;
  color: white;
}
.navbar .logo {
  color: #fff;
  font-size: 22px;
  font-weight: bold;
}
.navbar .nav-links {
  list-style: none;
  display: flex;
}
.navbar .nav-links li {
  margin-left: 20px;
}
.navbar .nav-links a {
  color: #fff;
  text-decoration: none;
  font-size: 16px;
  font-weight: bold;
  transition: color 0.3s ease;
}
.navbar .nav-links a:hover {
  color: #ffcc00;
}

    /* Simple admin table styling */
      .admin-container {
  padding: 40px;
  width: 95%;              /* Use 85% of screen width */
  max-width: 1600px;       /* Optional: limit it for large screens */
  margin: 0 auto;          /* Center it */
}

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    table, th, td {
      border: 1px solid #ccc;
    }
    th, td {
      padding: 12px;
      text-align: left;
    }
    th {
      background: #004d40;
      color: white;
    }
    tr:nth-child(even) {
      background: #f9f9f9;
    }
    h2 {
      text-align: center;
      color: #004d40;
    }
    .search-box {
      margin-bottom: 20px;
      text-align: right;
    }
    .search-box input[type="text"] {
      padding: 8px;
      width: 250px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .search-box button {
      padding: 8px 12px;
      background: #046e57ff;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .delete-btn {
      background: crimson;
      color: white;
      padding: 6px 10px;
      text-decoration: none;
      border-radius: 4px;
    }
    .delete-btn:hover {
      background: darkred;
    }
  </style>
</head>
<body>
   <!-- Navigation Bar -->
  <header>
    <nav class="navbar">
      <div class="logo">Admin Pannel</div>
      <ul class="nav-links">
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <div class="admin-container">
    <h2>Admission Applications</h2>

    <!-- Search Box -->
    <div class="search-box">
      <form method="GET" action="admin.php">
        <input type="text" name="search" placeholder="Search by name, email, phone, or course" value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Search</button>
      </form>
    </div>

   <table>
  <tr>
    <th>ID</th>
    <th>Full Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Course</th>
    <th>Education_Level</th>
    <th>Index_Number</th>
    <th>Submitted_at</th>
    <th>Action</th>
  </tr>
  <?php
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>".$row["id"]."</td>
                  <td>".$row["fullname"]."</td>
                  <td>".$row["email"]."</td>
                  <td>".$row["phone"]."</td>
                  <td>".$row["course"]."</td>
                  <td>".$row["Education_Level"]."</td>
                  <td>".$row["Index_Number"]."</td>
                  <td>".$row["submitted_at"]."</td>
                  <td><a href='admin.php?delete=".$row["id"]."' class='delete-btn' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a></td>
                </tr>";
      }
  } else {
      echo "<tr><td colspan='9'>No applications yet.</td></tr>";
  }
  ?>
</table>

  </div>
</body>
</html>

<?php $conn->close(); ?>
