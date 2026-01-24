<?php
include 'db_connect.php';
$result = $conn->query("SELECT * FROM contact_messages ORDER BY date_sent DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Contact Messages | Chief Loyal University</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #F5FFFA;
      margin: 0;
      padding: 0;
      color: #333;
    }

    /* Header Section */
    header {
      background: linear-gradient(135deg, #004d40, #00897b);
      color: white;
      padding: 20px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }

    header h1 {
      font-size: 24px;
      letter-spacing: 1px;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    header h1 i {
      color: #ffcc00;
    }

    .back-btn {
      background: #ffcc00;
      color: #004d40;
      padding: 8px 14px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
      transition: 0.3s;
    }

    .back-btn:hover {
      background: #fff176;
    }

    /* Dashboard Container */
    .container {
      max-width: 1100px;
      margin: 40px auto;
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      overflow-x: auto;
      animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .card-header {
      background: #004d40;
      color: white;
      padding: 18px 25px;
      font-size: 20px;
      font-weight: bold;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      min-width: 900px; /* Keeps structure on small screens */
    }

    th, td {
      padding: 12px 14px;
      border-bottom: 1px solid #ddd;
      text-align: left;
      word-wrap: break-word;
    }

    th {
      background: #00695c;
      color: white;
      font-weight: 600;
    }

    tr:nth-child(even) {
      background: #F0FFF0;
    }

    tr:hover {
      background: #e0f2f1;
      transition: 0.3s;
    }

    td i {
      color: #004d40;
      margin-right: 8px;
    }

    footer {
      text-align: center;
      padding: 15px;
      color: #777;
      font-size: 14px;
      margin-top: 30px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      header {
        flex-direction: column;
        text-align: center;
        gap: 10px;
      }

      header h1 {
        font-size: 20px;
      }

      .container {
        margin: 20px;
        box-shadow: none;
      }

      .card-header {
        font-size: 18px;
        text-align: center;
        justify-content: center;
      }

      table {
        font-size: 14px;
        min-width: unset;
      }

      th, td {
        padding: 10px 8px;
      }

      footer {
        font-size: 12px;
      }
    }

    @media (max-width: 480px) {
      header {
        padding: 15px 20px;
      }

      .back-btn {
        font-size: 14px;
        padding: 6px 10px;
      }

      table {
        font-size: 13px;
      }

      th, td {
        padding: 8px 6px;
      }
    }
  </style>
</head>
<body>
  <header>
    <h1><i class="fas fa-envelope-open-text"></i> Contact Messages</h1>
    <a href="dashboard_home.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
  </header>

  <div class="container">
    <div class="card-header">
      <i class="fas fa-inbox"></i> Messages Received from Visitors
    </div>
    <table>
      <thead>
        <tr>
          <th><i class="fas fa-hashtag"></i> ID</th>
          <th><i class="fas fa-user"></i> Name</th>
          <th><i class="fas fa-envelope"></i> Email</th>
          <th><i class="fas fa-heading"></i> Subject</th>
          <th><i class="fas fa-comment"></i> Message</th>
          <th><i class="fas fa-clock"></i> Date Sent</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><?= htmlspecialchars($row['name']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td><?= htmlspecialchars($row['subject']) ?></td>
              <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
              <td><?= $row['date_sent'] ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="6" style="text-align:center; color:gray;">No messages received yet.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <footer>
    &copy; <?= date('Y') ?> Chief Loyal University | Admin Panel
  </footer>
</body>
</html>
