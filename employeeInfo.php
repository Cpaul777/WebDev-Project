<?php 

include 'includes/db_connect.php';

if(!isset($_SESSION)) session_start();

if(!isset($_SESSION['email'])){
  header("Location: login.php");
  exit();
}

$id= $_SESSION['workerid'];
$timediff = 0;
$leaveerror = false;
$message = " ";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // echo '<>'
    $prevleave = $_POST['previousleave'];
    $currentdate = new DateTime(date('Y-m-d'));
    $startdatestamp = new DateTime($_POST['startdate']);
    $enddatestamp = new DateTime($_POST['enddate']);
    $timediff = $startdatestamp->diff($enddatestamp);
    $timediffdays = $timediff->days;
    $currenttimediff = $currentdate->diff($startdatestamp);
    $timediffnega = $timediff->invert;
    $currenttimediffnega = $currenttimediff->invert;

    if(($timediffnega == 1)||($timediff->days == 0)){
        $message = "NO TIME TRAVEL ALLOWED! (start date is equal to or greater than leave date)";
        $leaveerror = true;
    }
    else{
        if(($currenttimediffnega == 1)||($currenttimediff->days == 0)){
            $message = "NO TIME TRAVEL ALLOWED!!! (start date is on or behind current date)";
            $leaveerror = true;
        }
        else{
          if($prevleave < $timediff->days){
             $message = "You are attempting to create a leave notice beyond allotted PTO days, contact HR for more information";
             $leaveerror =true;
          }
          else{
            $remainingleave = ($prevleave-$timediff->days);
            $authorid = (int)$_SESSION['workerid'];
            $leavestart = $_POST['startdate'];
            $leaveend = $_POST['enddate'];
            $reason = $_POST['reason'];
            $status = $_POST['status'];
            $createleavestmt = $conn->prepare("INSERT INTO leaves (authorid,leavestart,leaveend,reason,status) VALUES (?, ?, ?, ?, ?)");
            $createleavestmt->bind_param("issss", $authorid,$leavestart, $leaveend,$reason,$status);
            $updateleavedaysstmt = $conn->prepare("UPDATE workers SET leaveDaysRemaining = ? WHERE workerId = ?");
            $updateleavedaysstmt->bind_param("ii",$remainingleave,$authorid);
            if ($createleavestmt->execute()&&$updateleavedaysstmt->execute()) {
                $message = "Leave Request created successfully";
            } else {
                $message = "Error: " . $stmt->error;
            }
            $createleavestmt->close();
          }
        }
     }
    
    if($leaveerror == true){
      $popupmessage = '<div class="pop-up" id="popupmsg"> Unable to create leave request </div>
      <script>
        setTimeout(function() {
       var el = document.getElementById("popupmsg");
       if (el) el.style.display = "none";
        }, 3000);
      </script>';
     }
       else{
      $popupmessage = '<div class="pop-up" id="popupmsg"> Leave request created successfully! <br>
      Number of days of leave selected: <strong>' . $timediff->days . ' day </strong> </div>
      <script>
        setTimeout(function() {
          var el = document.getElementById("popupmsg");
          if (el) el.style.display = "none";
        }, 5000);
      </script>';
       }
     
     
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
       echo $popupmessage;
     }
}


$stmt = $conn->prepare("SELECT firstName, lastName, emailId, role, gender, department,leaveDaysRemaining FROM workers WHERE workerId = ?");
    $stmt->bind_param("i", $id,);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($firstname, $lastname, $emailid, $role, $gender, $department,$leavedays);
    $stmt->fetch();

    $stmt = $conn->prepare("SELECT email FROM users WHERE userid = ?");
    $stmt->bind_param("i", $emailid,);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($email);
    $stmt->fetch();

    $firstname = ucfirst($firstname);
    $lastname = ucfirst($lastname);
    $role = ucfirst($role);
    $gender = ucfirst($gender);
    $department= ucfirst($department);

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($lastname);?>'s Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="styles/employeeinfo.css">
    
</head>
<body>
    <div class="container">
    <div class="header-row">
      <a class="back-btn" href="employeepage.php">
        <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false" style="width:20px;height:20px;vertical-align:middle;margin-right:6px;">
          <path d="M15 18l-6-6 6-6" stroke="white" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Back
      </a>
      <?php if($_SESSION['role'] == "Administrator" || $_SESSION['role'] == "administrator")
        echo'<div class="whole-back-btn">
        <a class="back-btn" href="index.php?tab=includes/dashboard.php">
          <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
            <path d="M15 18l-6-6 6-6" />
          </svg>Details
        </a>
      </div>';

      ?>
    </div>
    <div class="main-content">
      <div class="profile-card">
        <div class="pic-hold">
          <i class="bi bi-person placeholder-icon"></i>
        </div>
        <h3><?= ucfirst($firstname)." ".ucfirst($lastname)?></h3>
        <p class="role"><?=$role?></p>
        <p class="status">● Active</p>
        <hr />
        <div class="profile-info-block">
          <small>Email</small>
          <div class="profile-info-inline">
            <span><?=$email?></span>
          </div>
        </div>
        <div class="profile-info-block">
          <small>Phone Number</small>
          <span>0915-854-7892</span>
        </div>
        <div class="profile-info-block">
          <small>Department</small>
          <div><?=$department?></div>
        </div>
        <div class="logout">
          <form action="logout.php" method="post">
            <button class="logout-btn" type="submit">
              <i class="bi bi-box-arrow-right"></i> Logout
            </button>
          </form>
        </div>
      </div>

      <div class="tab-box">
        <div class="tabs-buttons">
          <div class="tab" id="tab1sw" data-tab="general"><a href="?tab=general" data-tab="general">General Information</a></div>
          <div class="tab" id="tab2sw" data-tab="leavereq"><a href="?tab=leavereq" >Leave Request</a></div>
          <div class="tab" id="tab3sw" data-tab="payslip"><a href="?tab=payslip" >Payslip</a></div>
        </div>

        <div class="tab-content active" id="general">
          <div class="card">
            <h3>Personal Information </h3>
            <div class="info-grid">
              <div class="row"><small>Full Name:</small> <strong><?= $firstname .' '. $lastname?></strong></div>
              <div class="row"><small>Gender:</small> <strong><?=$gender?></strong></div>
              <div class="row"><small>Date of Birth:</small> <strong>-</strong></div>
              <div class="row"><small>Marital Status:</small> <strong>-</strong></div>
              <div class="row"><small>Nationality:</small> <strong>Filipino</strong></div>
              <div class="row"><small>National ID Number:</small> <strong>-</strong></div>
              <div class="row"><small>Personal Tax ID:</small> <strong>-</strong></div>
              <div class="row"><small>Email Address:</small> <strong><?=$email?></strong></div>
              <div class="row"><small>Social Insurance:</small> <strong>-</strong></div>
              <div class="row"><small>Health Insurance:</small> <strong>-</strong></div>
              <div class="row"><small>Phone Number:</small> <strong>-</strong></div>
            </div>
          </div>
          <div class="card">
            <h3>Address</h3>
            <div class="info-grid">
              <div class="row"><small>Primary Address:</small> <strong>122-D JP Rizal, Project 4</strong></div>
              <div class="row"><small>City:</small> <strong>Quezon City</strong></div>
              <div class="row"><small>Country:</small> <strong>Philippines</strong></div>
              <div class="row"><small>Postal Code:</small> <strong>1109</strong></div>
              <div class="row"><small>State/Province:</small> <strong>Bicol</strong></div>
            </div>
          </div>
          <div class="card">
            <h3>Emergency Contact </h3>
            <div class="info-grid">
              <div class="row"><small>Full Name:</small> <strong>Maxwell Gutmann</strong></div>
              <div class="row"><small>Relationship:</small> <strong>Friend</strong></div>
              <div class="row"><small>Phone Number:</small> <strong>0915-250-8813</strong></div>
            </div>
          </div>
        </div>
        <!-- END OF INFO SECTION -->

        <div class="tab-content " id="leavereq">
             <div class="content">
                <div class="form-header">
                    <h2>Submit Leave Request</h2>
                    <p>Fill out the form to request time off</p>

                    <p>PTO days remaining : <?php echo $leavedays; ?></p>
                </div>
              </div>
            
            <?php if ($leaveerror == true ): ?>
                <div class="message <?php echo strpos($message, 'successfully') !== false ? 'message-success' : 'message-error'; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div> 
            <?php endif; ?>
            
            <form class="leave-form" method="POST">
                
              <div class="date-container">
                    <div class="form-group">
                         <label for="startdate">Start Date</label>
                        <input type="date" name="startdate" required><br>
                    </div>
                    
                    <div class="form-group">
                        <label for="enddate">End Date</label>
                        <input type="date" name="enddate" id="enddate" required>
                    </div>
              </div>
                
                <div class="form-group">
                    <label for="reason">Leave Reason</label>
                    <select name="reason" id="reason" class="leave-select">
                        <option value="medical">Medical</option>
                        <option value="pto">PTO</option>
                        <option value="parental">Parental</option>
                        <option value="bereavement">Bereavement</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <input type="hidden" name="workerid" value="<?php echo $_SESSION['workerid']; ?>">
                <input type="hidden" name="status" value="pending">
                <input type="hidden" name="previousleave" value="<?php echo $leavedays;?>">
                <button type="submit" class="btn btn-submit">
                    <i class="fas fa-paper-plane"></i> Submit Request
                </button>
            </form>
       </div>
        <!-- END OF SUBMIT REQUEST TYPE SHI -->

        <div class="tab-content " id="payslip">
          <div class="payslip-section">
            <h2 class="payslip-title">Payslip Details</h2>
            <div class="payslip-tabs">
              <button class="payslip-tab active" id="current">Current Payslip</button>
              <button class="payslip-tab" id="history">History</button>
            </div>

            <div class="current_payslip active">
                <div class="payslip-controls">
                <select class="payslip-period">
                  <option>June 1-15, 2025</option>
                </select>
                <div class="payslip-actions">
                  <button class="payslip-btn payslip-pdf">Download PDF</button>
                  <button class="payslip-btn payslip-print">Print</button>
                </div>
              </div>
              <div class="payslip-info-grid">
                <div><strong>Employee ID</strong><br><br>LP-2024-0001</div>
                <div><strong>Department</strong><br><br>Legislative</div>
                <div><strong>Position</strong><br><br>Barangay Treasurer</div>
                <div><strong>Pay Period</strong><br><br>June 1-15, 2025</div>
                <div><strong>Pay Date</strong><br><br>June 20, 2025</div>
                <div><strong>Payment Method</strong><br><br>Direct Deposit</div>
              </div>
              <div class="payslip-table-section">
                <h3>Earnings</h3>
                <table class="payslip-table">
                  <thead>
                    <tr>
                      <th>Description</th>
                      <th>Holidays/Days</th>
                      <th>Rate</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr><td>Basic Salary</td><td>11 days</td><td>₱1,500.00/day</td><td>₱16,500.00</td></tr>
                    <tr><td>Overtime</td><td>5 hours</td><td>₱280.00/hour</td><td>₱1,400.00</td></tr>
                    <tr><td>Special Holiday Pay</td><td>1 day</td><td>₱1,950.00</td><td>₱1,950.00</td></tr>
                    <tr class="payslip-total-row"><td colspan="3" style="text-align:right;"><strong>Total Gross Pay</strong></td><td><strong>₱21,850.00</strong></td></tr>
                  </tbody>
                </table>
                <h3>Deductions</h3>
                <table class="payslip-table">
                  <thead>
                    <tr>
                      <th>Description</th>
                      <th colspan="2"></th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr><td>SSS Contribution</td><td colspan="2"></td><td>₱900.00</td></tr>
                    <tr><td>PhilHealth</td><td colspan="2"></td><td>₱450.00</td></tr>
                    <tr><td>Pag-IBIG Fund</td><td colspan="2"></td><td>₱300.00</td></tr>
                    <tr><td>Withholding Tax</td><td colspan="2"></td><td>₱1,250.00</td></tr>
                    <tr><td>Salary Loan</td><td colspan="2"></td><td>₱2,000.00</td></tr>
                    <tr class="payslip-total-row"><td colspan="3" style="text-align:right;"><strong>Total Deductions</strong></td><td><strong>₱4,900.00</strong></td></tr>
                  </tbody>
                </table>
              </div>
              <div class="payslip-summary">
                <div class="payslip-netpay">
                  <span>Net Pay</span>
                  <span class="payslip-netpay-amount">₱16,950.00</span>
                </div>
                <div class="payslip-paidvia">
                  <span>Paid Via</span>
                  <span>BDO Account ****3452</span>
                </div>
              </div>
            </div>
            
            <div class="history">

            </div>

          </div>
        </div>
    </div>
  </div>
  <script src="script/employeepage.js"></script>
</body>
</html>
