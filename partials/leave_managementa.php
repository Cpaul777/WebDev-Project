<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Page 4</title>
    
    <link rel="stylesheet" href="../styles/leave_management.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600;800&display=swap" rel="stylesheet">
</head>

<body>
  <div class="top-menu">
    <div class="left">
      <a href="#">
        <i class="bi bi-layout-three-columns"></i>
        HR Dashboard
      </a>
    </div>
    <div class="right">
      <button id="notif-bell">
        <i class="bi bi-bell"></i>
      </button>
      <p>John Doe</p>
      <div class="profile-pic">
        <button id="profile-button">
          <i class="bi bi-person placeholder-icon"></i>
        </button>
      </div>
    </div>
  </div>

  <div class="main-content">
    <div class="side-bar">
      <div class="side-bar-content" role="tablist">
        <ul>
          <li>
            <a
              href="#"
              role="tab"
              aria-selected="false"
              aria-controls="dashboard-panel"
              class="nav-item tab-btn"
              data-page="includes/dashboard.php"
              aria-label="Dashboard Tab"
            >
              <i class="bi bi-view-stacked"></i>
              Dashboard
            </a>
          </li>
          <li>
            <a
              href="#"
              role="tab"
              aria-selected="false"
              aria-controls="employee-panel"
              class="nav-item tab-btn"
              data-page="includes/employee.php"
              aria-label="Employees Tab"
            >
              <i class="bi bi-person-vcard"></i>
              Employee
            </a>
          </li>
          <li>
            <a
              href="#"
              role="tab"
              aria-selected="false"
              aria-controls="payroll-panel"
              class="nav-item tab-btn"
              data-page="includes/payroll.php"
              aria-label="Payroll Tab"
            >
              <i class="bi bi-cash-stack"></i>
              Payroll
            </a>
          </li>
          <li>
            <a
              href="#"
              role="tab"
              aria-selected="false"
              aria-controls="calendar-panel"
              class="nav-item tab-btn"
              data-page="calendar.php"
              aria-label="Calendar Tab"
            >
              <i class="bi bi-calendar-check"></i>
              Calendar
            </a>
          </li>
          <li>
            <a
              href="#"
              role="tab"
              aria-selected="true"
              aria-controls="forms-panel"
              class="nav-item tab-btn active"
              data-page="forms.php"
              aria-label="Forms Tab"
            >
              <i class="bi bi-file-earmark-text"></i>
              Leave Application
            </a>
          </li>
          <li class="sign-out-item">
            <a href="#" class="nav-item">
              <i class="bi bi-box-arrow-right"></i>
              Sign out
            </a>
          </li>
        </ul>
      </div>
    </div>

    <div class="content-container">
      <h2 class="section-title">Leave Management</h2>

      <div class="summary-cards">
        <div class="summary-card">
          <h3>Pending Leaves</h3>
          <p class="count pending-count">9</p>
        </div>
        <div class="summary-card">
          <h3>Approved Leaves</h3>
          <p class="count approved-count">3</p>
        </div>
        <div class="summary-card">
          <h3>Rejected Leaves</h3>
          <p class="count rejected-count">2</p>
        </div>
      </div>

      <div class="approval-section">
        <div class="section-header">
          <h3>Leaves for Approval</h3>

          <div class="filters">
            <div class="search-container">
              <i class="bi bi-search"></i>
              <input
                type="text"
                id="searchInput"
                placeholder="Search by employee name or department"
                class="search-input">
            </div>

            <div class="filter-controls">
              <select id="departmentFilter" class="filter-select">
                <option value="">All Departments</option>
                <option value="Administration">Administration</option>
                <option value="Legislative">Legislative</option>
                <option value="Sangguniang Kabataan">Sangguniang Kabataan</option>
                <option value="Public Safety">Public Safety</option>
                <option value="Health and Social Services">Health and Social Services</option>
                <option value="Maintenance / Public works">Maintenance / Public works</option>
              </select>

              <select id="statusFilter" class="filter-select">
                <option value="">All Status</option>
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
                <option value="Rejected">Rejected</option>
              </select>

              <select id="leaveTypeFilter" class="filter-select">
                <option value="">All Leave Types</option>
                <option value="Vacation">Vacation</option>
                <option value="Sick Leave">Sick Leave</option>
                <option value="Personal Leave">Personal Leave</option>
                <option value="Maternity Leave">Maternity Leave</option>
                <option value="Paternity Leave">Paternity Leave</option>
                <option value="Special Leave benefits for women">Special Leave benefits for women</option>
                <option value="Unpaid Leave">Unpaid Leave</option>
              </select>
            </div>
          </div>
        </div>

        <div class="table-container">
          <table class="leave-table">
            <thead>
              <tr>
                <th>Employee</th>
                <th>Department</th>
                <th>Leave Type</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="leaveTableBody">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>