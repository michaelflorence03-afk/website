<?php
include 'db_connect.php';

// Add Programme
if (isset($_POST['add'])) {
  $programme = $_POST['programme'];
  $requirements = $_POST['requirements'];
  $capacity = $_POST['capacity'];
  $fee = $_POST['fee'];
  $duration = $_POST['duration'];

  $conn->query("INSERT INTO programmes (programme, requirements, capacity, fee, duration)
                VALUES ('$programme', '$requirements', '$capacity', '$fee', '$duration')");
  header("Location: manage_programmes.php");
}

// Delete Programme
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $conn->query("DELETE FROM programmes WHERE id=$id");
  header("Location: manage_programmes.php");
}

$programmes = $conn->query("SELECT * FROM programmes");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Programmes | Chief Loyal University</title>
  <link rel="stylesheet" href="dashboard_style.css">
</head>
<body class="programmes-body">
  <header class="page-header">
    <h1>Manage University Programmes</h1>
  </header>

  <section class="form-section">
    <form method="POST" class="add-form">
      <input type="text" name="programme" placeholder="Programme Name" required>
      <textarea name="requirements" placeholder="Admission Requirements" required></textarea>
      <input type="number" name="capacity" placeholder="Capacity" required>
      <input type="number" name="fee" placeholder="Fee" required>
      <input type="text" name="duration" placeholder="Duration (e.g. 3 years)" required>
      <button type="submit" name="add" class="btn-add">Add Programme</button>
    </form>
  </section>

  <section class="table-section">
    <table class="styled-table">
      <thead>
        <tr>
          <th>S/N</th>
          <th>Programme</th>
          <th>Requirements</th>
          <th>Capacity</th>
          <th>Fee</th>
          <th>Duration</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $sn = 1; while($row = $programmes->fetch_assoc()): ?>
        <tr>
          <td><?php echo $sn++; ?></td>
          <td><?php echo $row['programme']; ?></td>
          <td><?php echo $row['requirements']; ?></td>
          <td><?php echo $row['capacity']; ?></td>
          <td><?php echo $row['fee']; ?></td>
          <td><?php echo $row['duration']; ?></td>
          <td>
            <a href="?delete=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Delete this programme?');">Delete</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </section>
</body>
</html>
