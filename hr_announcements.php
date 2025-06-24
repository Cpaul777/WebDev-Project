<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HR Announcements</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <style>
    :root {
      --green: #008F05;
      --light-green: #dcfce7;
      --red: #fef2f2;
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

    .section-box {
      background-color: var(--white);
      border: 1px solid var(--gray-border);
      border-radius: 8px;
      padding: 20px 25px;
      margin-bottom: 30px;
    }

    .filters {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
    }

    .filters select {
      padding: 8px 10px;
      border: 1px solid #d1d5db;
      border-radius: 6px;
    }

    .announcement {
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 15px;
      border: 1px solid #e5e7eb;
      background-color: #ffffff;
    }

    .announcement.important {
      background-color: var(--red);
      border-left: 5px solid #dc2626;
    }

    .announcement.event {
      background-color: var(--light-green);
      border-left: 5px solid #16a34a;
    }

    .announcement .tag {
      font-size: 12px;
      font-weight: bold;
      display: inline-block;
      margin-bottom: 6px;
      color: #dc2626;
    }

    .announcement .tag.green {
      color: #065f46;
    }

    .announcement h4 {
      margin: 0;
      font-size: 16px;
    }

    .announcement p {
      font-size: 14px;
      margin: 8px 0;
      color: #374151;
    }

    .announcement .meta {
      font-size: 12px;
      color: #6b7280;
    }

    .announcement a {
      display: inline-block;
      margin-top: 6px;
      font-size: 13px;
      color: #10b981;
      text-decoration: none;
      font-weight: 500;
    }

    .announcement a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

    <?php include 'topMenu.php'; ?>

  <div class="main-content">
    <a href="employeepage.php" style="display:inline-block;margin-bottom:20px;padding:8px 18px;background:#008F05;color:#fff;border-radius:6px;text-decoration:none;font-weight:600;box-shadow:0 1px 4px rgba(0,143,5,0.08);"><i class="bi bi-arrow-left"></i> Return to Employee Page</a>
    <div class="section-box">
      <h2>HR Announcements</h2>
      <div class="filters">
      </div>

      <!-- Important Notice -->
      <div class="announcement important">
        <div class="tag">Important Notice &nbsp; <span style="font-weight: normal; font-size: 10px;">New</span></div>
        <h4>Office Safety Protocol Update</h4>
        <p>New safety protocols will be implemented starting June 25th. All employees must complete the safety training course before July 1st. Please check your email for detailed instructions.</p>
        <div class="meta">Posted 2 hours ago · HR Department</div>
        <a href="full_notice.php">Read Full Notice</a>
      </div>

      <!-- Event -->
      <div class="announcement event">
        <div class="tag green">Event</div>
        <h4>Job Fair in Las Piñas: Career Growth Opportunities</h4>
        <p>Join us for an exciting Job Fair featuring various career advancement opportunities. Meet department heads, learn about internal positions, and explore your career growth potential.</p>
        <div class="meta">June 15, 2025 · Main Conference Hall</div>
        <a href="#">View Full Details</a>
      </div>

      <!-- Regular Update 1 -->
      <div class="announcement">
        <h4>Employee Benefits Update: Healthcare Package Changes</h4>
        <p>We are pleased to announce improvements to our healthcare benefits package. Starting July 1st, all employees will have access to enhanced dental coverage and mental health resources.</p>
        <div class="meta">June 10, 2025</div>
        <a href="#">View Full Details</a>
      </div>

      <!-- Regular Update 2 -->
      <div class="announcement">
        <h4>Employee Benefits Update: Healthcare Package Changes</h4>
        <p>The annual performance review cycle will begin on July 15th. Please prepare your self-assessment documents and schedule a meeting with your supervisor before August 10th.</p>
        <div class="meta">June 5, 2025</div>
        <a href="#">View Full Details</a>
      </div>

    </div>
  </div>

</body>
</html> 