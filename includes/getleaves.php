<?php
include 'db_connect.php';

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
} 

if (!($_SESSION['role'] == 'administrator') && !($_SESSION['role'] == 'Administrator')) {
    echo 'it entered here?';
    header("Location: employeePage.php");
    exit();
}

$count_query = "SELECT COUNT(*) FROM leaves";
$total_records = mysqli_fetch_row(mysqli_query($conn, $count_query));

$count_query_pending = "SELECT COUNT(*) FROM leaves WHERE status = 'pending'";
$total_records_pending = mysqli_fetch_row(mysqli_query($conn, $count_query_pending));

$count_query_accepted = "SELECT COUNT(*) FROM leaves WHERE status = 'Accepted'";
$total_records_accepted = mysqli_fetch_row(mysqli_query($conn, $count_query_accepted));

$count_query_rejected = "SELECT COUNT(*) FROM leaves WHERE status = 'Rejected'";
$total_records_rejected = mysqli_fetch_row(mysqli_query($conn, $count_query_rejected));

// Grab da shit you need from leaves table
$sql = "SELECT itemid,authorid,leavestart,leaveend,reason,status FROM leaves";
$result = $conn->query($sql);

//prepare da query for the foreign key
$stmt = $conn->prepare("SELECT firstName,lastName,department FROM workers WHERE workerId = ?");
$stmt->bind_param("i", $workerid,);

$total = $total_records[0];
$total_pending = $total_records_pending[0];
$total_accepted = $total_records_accepted[0];
$total_rejected = $total_records_rejected[0];

?>

<div class="tab-content leave_management-tab" id="leave_management-panel" role="panel">
    <div class="in-container" >
        <h2 class="section-title">Leave Management</h2>

        <div class="summary-cards">
            <div class="summary-card">
              <h3>Total Record of Leaves</h3>
              <p class="count"><?=$total ?></p>
            </div>
            <div class="summary-card">
              <h3>Pending Leaves</h3>
              <p class="count pending-count"><?=$total_pending ?></p>
            </div>
            <div class="summary-card">
              <h3>Approved Leaves</h3>
              <p class="count approved-count"><?=$total_accepted ?></p>
            </div>
            <div class="summary-card">
              <h3>Rejected Leaves</h3>
              <p class="count rejected-count"><?=$total_rejected ?></p>
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
                    <!-- <option value="Special Leave benefits for women">Special Leave benefits for women</option> -->
                    <option value="Unpaid Leave">Unpaid Leave</option>
                </select>
                </div>
            </div>
            </div>

            <div class="table-container">
            <table class="leave-table">
                <thead>
                  <tr>
                    <th>ID</th>
                      <th>Employee</th>
                      <th>Department</th>
                      <th>Leave Start</th>
                      <th>Leave End</th>
                      <th>Reason</th>
                      <th>Action Taken</th>
                      <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="leaveTableBody">
                <?php 
          if ($result = $conn->query($sql)) {
                    while ($row = $result->fetch_assoc()) {
                        $workerid = $row["authorid"];
                        $stmt->execute();
                        $stmt->bind_result($firstname,$lastname,$department);
                        $stmt->fetch();
                        $fullname = $firstname." ".$lastname;
                        echo '<tr> 
                                  <td>'.$workerid.'</td> 
                                  <td>'.$fullname.'</td> 
                                  <td>'.$department.'</td> 
                                  <td>'.$row['leavestart'].'</td>
                                  <td>'.$row['leaveend'].'</td>
                                  <td>'.$row['reason'].'</td>
                                  <td class="status '.strtolower($row['status']).'">'.$row['status'].'</td>';
                        if($row['status'] == 'pending'){
                            echo
                                  '
                                  <td> 
                                    <div class="action-buttons">
                                      <a href="includes/changestate.php?id='.$row['itemid'].'&action=accept'.'"class="action-btn">Accept</a>
                                      <span class="action-separator">|</span>
                                        <a href="includes/changestate.php?id='.$row['itemid'].'&action=reject'.'" class="action-btn reject">Reject</a>
                                    </div>
                                  </td>
                              </tr>';
                        }
                        else{
                            echo    
                                    '<td class="accomplished"> 
                                        Accomplished 
                                       <!-- <a href="#"><i class="bi bi-trash"></i></a> -->
                                    </td>
                                </tr>';
                        }
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
        <!-- <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Leave Start</th>
                    <th>Leave End</th>
                    <th>Reason</th>
                    <th>Action Taken</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

    
            </tbody>
        </table> -->