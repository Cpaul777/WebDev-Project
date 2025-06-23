<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Create Support Ticket</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"/>
  <style>
    :root {
      --green: #008F05;
      --white: #ffffff;
      --light-gray: #f3f4f6;
      --gray-border: #d1d5db;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: #f9fafb;
      margin: 0;
      padding: 0;
    }

    .top-menu {
      height: 60px;
      background-color: var(--green);
      color: var(--white);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 20px;
    }

    .main-container {
      max-width: 800px;
      margin: 40px auto;
      background: var(--white);
      border: 1px solid var(--gray-border);
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
    }

    h2 {
      color: #065f46;
      margin-bottom: 10px;
    }

    label {
      font-weight: 500;
      display: block;
      margin: 15px 0 5px;
    }

    input, select, textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      font-family: inherit;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    button {
      background: var(--green);
      color: var(--white);
      border: none;
      padding: 12px 20px;
      font-weight: 600;
      border-radius: 6px;
      cursor: pointer;
    }

    .back-button {
      display: inline-block;
      margin-bottom: 20px;
      text-decoration: none;
      color: #065f46;
      font-weight: 500;
    }

    .back-button i {
      margin-right: 5px;
    }
  </style>
</head>
<body>

  <div class="top-menu">
    <div><i class="bi bi-layout-three-columns"></i> Las Piñas Information System Portal</div>
    <div>June 18, 2025 | Wednesday</div>
  </div>

  <div class="main-container">
    <a href="hr_helpdesk.php" style="display:inline-block;margin-bottom:20px;padding:8px 18px;background:#008F05;color:#fff;border-radius:6px;text-decoration:none;font-weight:600;box-shadow:0 1px 4px rgba(0,143,5,0.08);"><i class="bi bi-arrow-left"></i> Back to Help Desk</a>
    <h2>Create Support Ticket</h2>
    <form>
      <label for="category">Category</label>
      <select id="category" name="category" required>
        <option value="">-- Select Category --</option>
        <option value="payroll">Payroll</option>
        <option value="leave">Leave & Time Off</option>
        <option value="benefits">Benefits</option>
        <option value="technical">Technical Issue</option>
        <option value="other">Other</option>
      </select>

      <label for="message">Message / Description</label>
      <textarea id="message" name="message" rows="5" placeholder="Describe your concern here..." required></textarea>

      <button type="submit">Submit Ticket</button>
    </form>
  </div>

</body>
</html> 