<?php
include 'db_connect.php';
session_start();

// Check if the user is logged in, if
// not then redirect them to the login page

if(!isset($_SESSION['email'])){
  header("Location: login.php");
  exit();
}

if (!isset( $_GET['offset']) || $_GET['offset'] < 0 ) {
    $offset = 0;
} else {
    $offset = ($_GET['offset']-1)*3;
}
$query = "SELECT * FROM workers ORDER BY workerId DESC LIMIT 5 OFFSET $offset";
$total_count = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM workers"));

?>

<body>
<div class="tab-content dashboard-tab" id="dashboard-panel" role="panel">
    <div class="top-cards">
        <div class="card total-employees" >
            <div class="header">
                <p>Total Employees </p> <i class="bi bi-person"></i>
            </div>
            <div class="content">
                <?php echo '<h3>' . $total_count[0] . '</h3>'; ?>
            </div>
        </div>
        
        <div class="card payroll">
            <div class="header">
                <p>Upcoming Payroll</p>
                <i class="bi bi-coin"></i>
            </div>
            <div class="content">
                <h3>May 30</h3>
                <p>3 days remaining</p>
            </div>
        </div>

        <div class="card pending-approval">
            <div class="header">
                <p>Pending Approvals</p>
                <i class="bi bi-clock"></i>
            </div>
            <div class="content">
                <h3>7</h3>
                <p></p>
            </div>
        </div>

    </div>

    <div class="mid-card">
        <div class="dept-distribution">
            <div class="dept-header">
                <h3>Department Distribution</h3>
            </div>
            
            <div class="content">

                <div class="grid administration">
                    <div class="header">
                        <i class="bi bi-person-gear"></i>   
                        <p>Administration</p>
                    </div>
                    <div class="stuff">
                        <div class="employee-count">4</div>
                    </div>
                    <div class="progress-container">
                        <div class="progress-bar"></div>
                    </div>
                    <div class="percentage" >25%</div>
                </div>

                <div class="grid legislative">
                    <div class="header">
                        <i class="bi bi-buildings"></i>
                        <p>Legislative</p>
                    </div>
                    <div class="stuff">
                        <div class="employee-count">7</div>
                    </div>

                    <div class="progress-container">
                        <div class="progress-bar"></div>
                    </div>
                    <div class="percentage">36%</div>
                </div>

                <div class="grid sanggunian">
                    <div class="header">
                        <i class="bi bi-shield"></i>
                        <p>Sanggunian Kabataan</p>
                    </div>
                    <div class="stuff">
                        <div class="employee-count">8</div>
                        
                    </div>
                     <div class="progress-container">
                        <div class="progress-bar"></div>
                    </div>
                    <div class="percentage" >22%</div>
                </div>

                <div class="grid safety-health">
                    <div class="header">
                        <i class="bi bi-heart-pulse"></i>
                        <p>Safety & Health Services</p>
                    </div>
                    <div class="stuff">
                    <div class="employee-count">15</div>
                    
                    </div>
                     <div class="progress-container">
                        <div class="progress-bar"></div>
                    </div>
                    <div class="percentage">17%</div>
                </div>
            </div>
        </div>
        <div class="off-today">
            <div class="header">
                    <p>Who's Off Today</p>
                    <div class="view-all" onclick="showModal()">View all</div>
            </div>
            <div class="content">
                <div class="entry">
                    <div class="name">John Dee</div>
                    <div class="date">26 May - 27 May</div>
                </div>
                <div class="entry">
                    <div class="name">Jesse Daniels</div>
                    <div class="date">26 May</div>
                </div>
                <div class="entry">
                    <div class="name">Sheraz Shah</div>
                    <div class="date">28 May</div>
                </div>
                <div class="entry">
                    <div class="name">Sunny Ynnus</div>
                    <div class="date">30 May</div>
                </div>
            </div> 
        </div>
    </div>
    
    <div class="bottom-card">
        <div class="employee-status">
           <div class="header">
                <h3>Employee Status</h3>
                <div class="all" onclick="employeePage()">View all</div>
           </div>
           <div class="employee-content">
                <table class="leave-table">
                    <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Role</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody id="leaveTableBody">
                        <?php
                        if ($result = $conn->query($query)) {
                            while ($row = $result->fetch_assoc()) {
                                $firstname = $row["firstName"];
                                $lastname = $row["lastName"];
                                $role = $row["role"];
                                $department = $row["department"];
                                $id = $row['workerId'];
                                $status = '';
                                $stmt = $conn->prepare("SELECT status FROM leaves WHERE authorid = ?");
                                $stmt->bind_param("i", $id);
                                $stmt->execute();
                                $stmt->store_result();
                                if($stmt->num_rows > 0){
                                    $stmt->bind_result($status);
                                    $stmt->fetch();
                                }
                                echo '<tr>
                                        <td class="employee-name">'.$firstname.' '.$lastname.'</div></td>
                                        <td class="department">'.$department.'</td>
                                        <td class="role">'.$role.'</td>
                                        <td class="status '.strtolower($status).'">'.$status.'</td>
                                    </tr>';
                            }
                            $result->free();
                        }
                     ?>
                    </tbody>
                </table>
           </div>
        </div>
    </div>
</div>



<div class="off-modal" id="modalDetails">
    <div class="off-modal-content">
        <div class="modal-header">
            <h2 class="modal-title"><i class="bi bi-person-slash"></i>On Leave</h2>
            <button class="close-btn" onclick="closeModal()"><i class="bi bi-x"></i></button>
            <h2 class="date"><i class="bi bi-calendar-event"></i>Monday, 26 May 2025</h2>
            <h2 class="below-words"><i class="bi bi-people"></i> 5 People</h2>
            <hr>
        </div>
        
        <div class="off-modal-body">
            <div class="inside-entry">
                <div class="profile-picture"><i class="bi bi-person-circle"></i></div>
                <div class="details">
                    <div class="inside-name">John Dee</div>
                    <div class="date">26 May - 27 May</div>
                    <div class="role">Tanod</div>
                </div>
                
                
            </div>
            <div class="inside-entry">
                <div class="profile-picture"><i class="bi bi-person-circle"></i></div>
                <div class="details">
                    <div class="inside-name">Jesse Daniels</div>
                    <div class="date">26 May</div>
                    <div class="role">Barangay Clerk</div>
                </div>
            </div>
            <div class="inside-entry">
                <div class="profile-picture"><i class="bi bi-person-circle"></i></div>
                <div class="details">
                    <div class="inside-name">Sheraz Shah</div>
                    <div class="date">28 May</div>
                    <div class="role">SK Kagawad</div>
                </div>
            </div>
            <div class="inside-entry">
                <div class="profile-picture"><i class="bi bi-person-circle"></i></div>
                <div class="details">
                    <div class="inside-name">Sunny Ynnus</div>
                    <div class="date">30 May</div>
                    <div class="role">Education Committee</div>
                </div>
            </div>
            <div class="inside-entry">
                <div class="profile-picture"><i class="bi bi-person-circle"></i></div>
                <div class="details">
                    <div class="inside-name">Michael Jan</div>
                    <div class="date">27 May</div>
                    <div class="role">Tanod</div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

