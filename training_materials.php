<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Training Materials</title>
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

    .top-menu {
      height: var(--top-bar-height);
      background-color: var(--green);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 20px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      z-index: 100;
      position: sticky;
      top: 0;
    }

    .top-menu a {
      color: var(--white-color);
      text-decoration: none;
      margin-left: 20px;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .top-menu .right {
      color: var(--white-color);
      display: flex;
      align-items: center;
      gap: 20px;
      font-size: 14px;
      text-align: right;
    }

    .top-menu .right .profile-pic {
      width: 40px;
      height: 40px;
      background: var(--white-color);
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .top-menu .right .profile-pic i {
      font-size: 20px;
      color: var(--green);
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

    .material-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .material-header h1 {
      margin: 0;
      color: #065f46;
    }

    .material-header button {
      background-color: #008F05;
      color: #fff;
      border: none;
      padding: 8px 18px;
      border-radius: 6px;
      font-weight: 600;
      cursor: pointer;
    }

    .material-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr); 
      gap: 20px;
      margin-top: 20px;
    }

    .material-card {
      background: #f9fafb;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      padding: 16px;
      display: flex;
      flex-direction: column;
      gap: 8px;
      position: relative;
      font-size: 13px;
    }

    .material-card .icon {
      font-size: 20px;
      color: #10b981;
    }

    .material-card h4 {
      margin: 0;
      font-size: 15px;
      color: #111827;
    }

    .material-card p {
      font-size: 13px;
      color: #6b7280;
      margin: 0;
    }

    .material-card small {
      font-size: 11px;
      color: #6b7280;
    }

    .badge {
      font-size: 10px;
      background-color: #facc15;
      color: #78350f;
      padding: 2px 6px;
      border-radius: 999px;
      font-weight: 600;
      position: absolute;
      top: 8px;
      right: 8px;
    }

    .recommended-section h2 {
  margin-bottom: 20px;
  color: #111827;
  font-size: 16px;
  font-weight: 600;
}

.recommended-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 20px;
}

.recommended-card {
  display: flex;
  background: #ffffff;
  border-radius: 10px;
  padding: 15px;
  border: 1px solid #e5e7eb;
  align-items: center;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
}

.recommended-card .icon-area {
  width: 50px;
  height: 50px;
  background: #f3f4f6;
  border-radius: 10px;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-right: 16px;
  font-size: 22px;
}

.recommended-card .info h4 {
  margin: 0 0 4px;
  font-size: 14px;
  font-weight: 600;
  color: #111827;
}

.recommended-card .info p {
  margin: 0 0 4px;
  font-size: 13px;
  color: #4b5563;
}

.recommended-card .info small {
  display: block;
  font-size: 11px;
  color: #6b7280;
  margin-bottom: 4px;
}

.recommend-tag {
  font-size: 11px;
  font-weight: 500;
  color: #059669;
  background-color: #ecfdf5;
  padding: 2px 8px;
  border-radius: 20px;
  display: inline-block;
}

.bg-blue .icon-area {
  background-color: #e0f2fe;
  color: #3b82f6;
}

.bg-green .icon-area {
  background-color: #d1fae5;
  color: #10b981;
}

  </style>
</head>
<body>

  <div class="top-menu">
    <a href="#"><i class="bi bi-layout-three-columns"></i>Las Piñas Information System Portal</a>
    <div class="right">
      <span>June 18, 2025<br><small>Wednesday</small></span>
      <div class="profile-pic" id="profile-button">
        <i class="bi bi-person"></i>
      </div>
    </div>
  </div>

  <div class="main-content">
    <a href="employeepage.php" style="display:inline-block;margin-bottom:20px;padding:8px 18px;background:#008F05;color:#fff;border-radius:6px;text-decoration:none;font-weight:600;box-shadow:0 1px 4px rgba(0,143,5,0.08);"><i class="bi bi-arrow-left"></i> Return to Employee Page</a>
    <div class="section-box">
      <div class="material-header">
        <h1>Training Materials</h1>
        <button>All Materials</button>
      </div>

      <div class="material-grid">
        <div class="material-card" style="border-left: 5px solid #10b981;">
          <i class="bi bi-journal-check icon"></i>
          <h4>Employee Handbook 2025</h4>
          <p>Comprehensive guide to policies, benefits, and workplace conduct for Las Piñas personnel.</p>
          <small>Updated: May 15, 2025 • Duration: 1hr</small>
        </div>

        <div class="material-card" style="border-left: 5px solid #60a5fa;">
          <i class="bi bi-laptop icon"></i>
          <span class="badge">Pending</span>
          <h4>Cybersecurity Fundamentals</h4>
          <p>Essential strategies for ensuring government data protection and productivity safety.</p>
          <small>Created: June 1, 2025 • Duration: 45min</small>
        </div>

        <div class="material-card" style="border-left: 5px solid #f87171;">
          <i class="bi bi-hospital icon"></i>
          <h4>Emergency Response Training</h4>
          <p>Learn standard crisis response techniques including evacuation and fire drills.</p>
          <small>Updated: April 25, 2025 • Duration: 30min</small>
        </div>

        <div class="material-card" style="border-left: 5px solid #a78bfa;">
          <i class="bi bi-award icon"></i>
          <h4>Citizen Service Excellence</h4>
          <p>Best practices for providing excellent service to Las Piñas constituents.</p>
          <small>Created: March 20, 2025 • Duration: 45min</small>
        </div>

        <div class="material-card" style="border-left: 5px solid #fbbf24;">
          <i class="bi bi-building icon"></i>
          <span class="badge" style="background:#bbf7d0; color:#15803d;">Complete</span>
          <h4>Administrative Procedures</h4>
          <p>Guide to document workflows, procurement, and reporting standards.</p>
          <small>Last Accessed: June 10, 2025 • Duration: 1hr</small>
        </div>

        <div class="material-card" style="border-left: 5px solid #34d399;">
          <i class="bi bi-person-badge icon"></i>
          <h4>Leadership Development</h4>
          <p>Advance your leadership skills. Ideal for team leads and management.</p>
          <small>Created: June 5, 2025 • Duration: 1hr 20min</small>
        </div>
      </div>

      <div class="recommended-section">
  <h2>Recommended For You</h2>
  <div class="recommended-grid">
    
    <div class="recommended-card bg-blue">
      <div class="icon-area">
        <i class="bi bi-person-standing icon"></i>
      </div>
      <div class="info">
        <h4>Public Speaking Workshop</h4>
        <p>Enhance your presentation skills for public meetings and official events.</p>
        <small>Duration: 1:00 min</small>
        <span class="recommend-tag">Recommended based on your role</span>
      </div>
    </div>

    <div class="recommended-card bg-green">
      <div class="icon-area">
        <i class="bi bi-file-earmark-excel icon"></i>
      </div>
      <div class="info">
        <h4>Advanced Excel for Administrators</h4>
        <p>Master advanced spreadsheet techniques for budget management and data analysis.</p>
        <small>Duration: 90 min</small>
        <span class="recommend-tag">Recommended based on your department</span>
      </div>
    </div>

  </div>
</div>

    </div>
  </div>

</body>
</html> 