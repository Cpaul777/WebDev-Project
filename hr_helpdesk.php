<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HR Help Desk</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <style>
    :root {
      --top-bar-height: 60px;
      --white-color: #ffffff;
      --dark-color: #333333;
      --very-light-green: #bfffc2;
      --green: #008F05;
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
      background: #ffffff;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      padding: 25px 30px;
      margin-bottom: 30px;
      box-shadow: 0 1px 5px rgba(0, 0, 0, 0.03);
    }

    .faq-item {
      background-color: #f9f9f9;
      padding: 15px 20px;
      margin-bottom: 15px;
      border-radius: 5px;
    }

    .faq-item h4 {
      margin: 0 0 10px;
      color: #047857;
    }

    .support-ticket {
      background-color: #f3f4f6;
      padding: 20px;
      border-radius: 8px;
      text-align: center;
      margin: 40px 0 30px;
    }

    .support-ticket a {
      background-color: #008F05;
      color: white;
      padding: 10px 20px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 600;
      display: inline-block;
      margin-top: 10px;
    }

    .contact-info {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 20px;
      padding-top: 20px;
    }

    .contact-info div {
      flex: 1;
      min-width: 200px;
    }

    h1 {
        color: black;
    }
    
     h2, h3 {
      color: #065f46;
    }
  </style>
</head>
<body>

   <?php include 'topMenu.php'; ?>

  <div class="main-content">
    <a href="employeepage.php" style="display:inline-block;margin-bottom:20px;padding:8px 18px;background:#008F05;color:#fff;border-radius:6px;text-decoration:none;font-weight:600;box-shadow:0 1px 4px rgba(0,143,5,0.08);"><i class="bi bi-arrow-left"></i> Return to Employee Page</a>
    <div class="section-box">
      <h1>HR Help Desk</h1>
      <p>Get assistance with HR-related inquiries and concerns.</p>

      <h2>Frequently Asked Questions</h2>

      <div class="faq-item">
        <h4>How do I update my personal information?</h4>
        <p>You can update your personal information by logging into your employee portal account and navigating to the "Profile" section. If you encounter any issues, please contact the HR department for assistance.</p>
      </div>

      <div class="faq-item">
        <h4>What documents do I need to apply for leave?</h4>
        <p>To apply for leave, you need to submit a leave application form through the Time In/Time Out system at least 3 days in advance for planned leaves. For emergency or sick leaves, please notify your supervisor as soon as possible and submit the necessary medical certificates upon return.</p>
      </div>

      <div class="faq-item">
        <h4>How can I access my payslip?</h4>
        <p>You can access your payslip through the "Payslip" section in the Quick Access menu of the portal. Payslips are typically available two days before the scheduled payday. For previous payslips, you can use the date filter to find specific pay periods.</p>
      </div>

      <div class="faq-item">
        <h4>When are performance evaluations conducted?</h4>
        <p>Performance evaluations are conducted bi-annually, in June and December. You will receive a notification through the portal when the evaluation period begins. The process includes self-assessment, supervisor evaluation, and a feedback discussion.</p>
      </div>

      <div class="faq-item">
        <h4>How do I enroll in or change my benefits?</h4>
        <p>Benefit enrollment or changes can be made during the annual open enrollment period in November or within 30 days of a qualifying life event (marriage, birth of a child, etc.). Please contact the HR Benefits Coordinator for assistance with specific benefit inquiries.</p>
      </div>

      <div class="support-ticket">
        <h3>Support Tickets</h3>
        <p>Need help with a specific HR issue? Create a support ticket or check the status of your existing tickets.</p>
        <a href="create_support_ticket.php">Create Support Ticket</a>
      </div>

      <h3>Contact HR Department</h3>
      <div class="contact-info">
        <div>
          <strong>Email</strong><br>
          laspinascitygov@yahoo.com
        </div>
        <div>
          <strong>Office Hours</strong><br>
          Monday - Friday: 8:00 AM - 5:00 PM
        </div>
        <div>
          <strong>Phone</strong><br>
          +63 998 861 4577
        </div>
        <div>
          <strong>Location</strong><br>
          3rd Floor, City Hall Building, Las Piñas
        </div>
      </div>
    </div>
  </div>

</body>
</html> 