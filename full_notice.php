<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Full Notice - Office Safety Protocol</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <style>
    :root {
      --green: #008F05;
      --white: #ffffff;
      --gray-border: #d1d5db;
    }

    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #f9fafb;
      color: #1f2937;
    }

    
    .main-content {
      padding: 40px 60px;
    }

    .notice-box {
      background-color: var(--white);
      border: 1px solid var(--gray-border);
      border-radius: 8px;
      padding: 30px;
    }

    h1, h2 {
      color: #dc2626;
    }

    .meta {
      font-size: 13px;
      color: #6b7280;
      margin-bottom: 20px;
    }

    .back-button {
      margin-top: 30px;
      display: inline-block;
      padding: 10px 15px;
      background-color: var(--green);
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      font-size: 14px;
    }
  </style>
</head>
<body>

   <?php include 'topMenu.php'; ?>

  <div class="main-content">
    <div class="notice-box">
      <h1>Office Safety Protocol Update</h1>
      <div class="meta">Published: June 18, 2025 &nbsp;&bull;&nbsp; HR Department</div>
      <p>To all employees,</p>

      <p>In compliance with updated national safety regulations, the Las Piñas Local Government will be implementing new safety protocols across all departments starting <strong>June 25th, 2025</strong>. These measures aim to ensure a safe and secure working environment for all staff.</p>

      <h2>Mandatory Training</h2>
      <p>All employees are required to complete the updated safety training course no later than <strong>July 1st, 2025</strong>. The training will be conducted online via the internal training portal. Attendance is mandatory and will be monitored by department heads.</p>

      <h2>Key Protocols</h2>
      <ul>
        <li>Daily health screenings at building entry points</li>
        <li>Mandatory use of face masks in all shared spaces</li>
        <li>Social distancing in meeting rooms and common areas</li>
        <li>Increased sanitation and cleaning procedures</li>
      </ul>

      <h2>Support and Questions</h2>
      <p>If you encounter any issues accessing the training materials or have any concerns, please contact the HR Help Desk immediately.</p>

      <p>Thank you for your cooperation in maintaining a safe workplace.</p>
      <p>— HR Department</p>

      <a href="hr_announcements.php" class="back-button"><i class="bi bi-arrow-left"></i> Back to HR Announcements</a>
    </div>
  </div>

</body>
</html> 