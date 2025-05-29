<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page1</title>
    <link rel="stylesheet" href="style.css">
    <style></style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600;800&display=swap" rel="stylesheet">

    
</head>
<body>

    <!--Top Bar-->
    <div class="top-menu">
        <a href="#"><i class="bi bi-layout-three-columns"></i> HR Dashboard</a>
        <div class="right">
            <button id="notif-bell"><i class="bi bi-bell"></i></button>
            <p>Name</p>
            <div class="profile-pic">
            <button id="profile-button">
                <i class="bi bi-person placeholder-icon"></i>
            </button>
            </div>
        </div>
    </div>

    <div class="profile-drop-down">
    <!-- TO DO -->
    </div>


<!-- ARIA (Accessible Rich Internet Applications) implemented its basically for improving accessibility-->
    <div class="main-content">
        <!-- Side Bar -->
        <div class="side-bar">
            <div class="side-bar-content" role="tablist">
                <ul>
                    <!-- The tab role lists them as tab so when and its control is based on the id of the div of the other file -->
                    <li><a role="tab" aria-selected="true" 
                    aria-controls="dashboard-panel" class="tab-btn active" 
                    data-page="includes/dashboard.php" aria-label="Dashboard Tab">
                            <i class="bi bi-view-stacked"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    
                    <li><a role="tab" aria-selected="false" 
                    aria-controls="employee-panel" class="tab-btn" 
                    data-page="includes/employees.php" data-key="offset" aria-label="Employees Tab">
                            <i class="bi bi-person-vcard"></i> 
                            <p>Employees</p>
                        </a>
                    </li>
                    <li><a role="tab" aria-selected="false" 
                    aria-controls="payroll-panel" class="tab-btn" 
                    data-page="includes/payroll.php" aria-label="Payroll Tab">
                            <i class="bi bi-cash-stack"></i> 
                            <p>Payroll</p>
                        </a>
                    </li>

                    <li><a role="tab" aria-selected="false" 
                    aria-controls="calendar-panel" class="tab-btn" 
                    data-page="calendar.php" aria-label="Calendar Tab">
                            <i class="bi bi-calendar-check"></i> 
                            <p>Calendar</p>
                        </a>
                    </li>

                    <li><a role="tab" aria-selected="false" 
                    aria-controls="forms-panel" class="tab-btn" 
                    data-page="forms.php" aria-label="Forms Tab">
                            <i class="bi bi-file-earmark-text"></i> 
                            <p>Leave Application</p>
                        </a>
                    </li>
                </ul>
            <!-- <div class="sign-out"><a href="#"><i class="bi bi-box-arrow-right"></i> Sign Out</a></div> -->
            </div>
        </div>

        <!-- Tab Content -->
        <div class="content-container" id="content-container">
            
        </div>
<!-- why -->
    </div>
    <script src="index.js" charset="UTF-8"></script>
</body>
</html>