<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Management</title>

    <link rel="stylesheet" href="styles/style.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600;800&display=swap" rel="stylesheet">

</head>
<?php
if(!isset($_SESSION)) session_start();

// Check if the user is logged in, if
// not then redirect them to the login page
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

if (!($_SESSION['role'] == 'administrator') && !($_SESSION['role'] == 'Administrator')) {
    header("Location: employeepage.php");
    exit();
}
if (!isset( $_GET['offset']) || $_GET['offset'] < 0 ) {
    $offset = 0;
} else {
    $offset = $_GET['offset'];
}


?>
<body>

    <!--Top Bar-->
    <div class="top-menu">
        <button class="mobile-menu-toggle" id="mobileMenuToggle">
            <i class="bi bi-list"></i>
        </button>
        <a href="index.php"><i class="bi bi-layout-three-columns"></i> Las Piñas HR Management</a>
        <div class="right">
            <button id="notif-bell"><i class="bi bi-bell"></i></button>
            <p><?php echo $_SESSION['email'];?></p>
            <div class="profile-pic" id="profile-button" onclick="profileDropDown()">
                <i class="bi bi-person placeholder-icon"></i>
                <!-- <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwJajj1uV_edHd0ntvX5m4LViJdcM082rD-A&s" alt="PAKYAW"> -->
            </div>
        </div>
    </div>

    <div class="profile-drop-down" id="profile-drop-down">
        <div style="padding: 12px 16px; border-bottom: 1px solid #e5e7eb;">
            <p style="font-weight: 500; color: #111827;"><?php echo $_SESSION['firstname']," ",$_SESSION['lastname'] ;?></p>
            <p style="font-size: 12px; color: #6b7280;">Administrator</p>
        </div>
        <a href="#" style="display: block; padding: 12px 16px; text-decoration: none; color: #374151; font-size: 14px; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='transparent'">Profile Settings</a>
        <a href="#" style="display: block; padding: 12px 16px; text-decoration: none; color: #374151; font-size: 14px; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='transparent'">Account Settings</a>
        <a href="#" style="display: block; padding: 12px 16px; text-decoration: none; color: #374151; font-size: 14px; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='transparent'">Help & Support</a>
        <hr style="margin: 8px 0; border: none; border-top: 1px solid #e5e7eb;">
        <a href="#" style="display: block; padding: 12px 16px; text-decoration: none; color: #dc2626; font-size: 14px; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='transparent'" onclick="handleSignOut()">Sign Out</a>
    </div>

<!-- ARIA (Accessible Rich Internet Applications) implemented its basically for improving accessibility-->
    <div class="main-content">
        <!-- Side Bar -->
        <div class="side-bar" id="sidebar">
            <div class="side-bar-content" role="tablist">
                <ul>
                    <!-- The tab role lists them as tab so when and its control is based on the id of the div of the other file -->
                    <li><a role="tab" aria-selected="true" 
                    aria-controls="dashboard-panel" class="tab-btn active" 
                    data-page="includes/dashboard.php" data-tab-name="dashboard" aria-label="Dashboard Tab">
                            <i class="bi bi-view-stacked"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    
                    <li><a role="tab" aria-selected="false" 
                    aria-controls="employee-panel" class="tab-btn" 
                    data-page="includes/employees.php" data-tab-name="employees" aria-label="Employees Tab">
                            <i class="bi bi-person-vcard"></i> 
                            <p>Employees</p>
                        </a>
                    </li>
                    <li><a role="tab" aria-selected="false" 
                    aria-controls="payroll-panel" class="tab-btn" 
                    data-page="includes/payroll.php" data-tab-name="payroll" aria-label="Payroll Tab">
                            <i class="bi bi-cash-stack"></i> 
                            <p>Payroll</p>
                        </a>
                    </li>

                    <li><a id="leave_management" role="tab" aria-selected="false" 
                    aria-controls="leave_management-panel" class="tab-btn"
                    data-page="includes/getleaves.php" data-tab-name="leave_management" aria-label="Leave Management Tab">
                            <i class="bi bi-file-earmark-text"></i> 
                            <p>Leave Application</p>
                        </a>
                    </li>
                </ul>
            
            </div>
        </div>

        <!-- Tab Content -->
        <div class="content-container">
            <div class="content-wrapper" id="content-wrapper">
                
            </div>
        </div>
    <div class="mobile-overlay" id="overlay"></div>
<!-- why --> <!-- why what -->
    </div>
    <script src="script/index.js" charset="UTF-8"></script>
</body>
</html>