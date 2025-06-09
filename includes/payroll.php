<?php
include 'db_connect.php';
session_start();

// Check if the user is logged in, if
// not then redirect them to the login page
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}


// Grab da shit you need from workers table
$sql = "SELECT workerId,firstName,lastName,department,role,basePay,overtimeRate FROM workers";
?>

<div class="top-bar">
    <h3 class="section-title" id="payroll-tab" onclick="employeeWord()">Employee Slip</h3>
</div>
   
<div class="table-container">
    <table class="payslip-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Role</th>
                    <th>Base Pay</th>
                    <th>Overtime Rate</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                    if ($result = $conn->query($sql)) {
                                while ($row = $result->fetch_assoc()) {
                                    $fullname = $row['firstName']." ".$row['lastName'];
                                    echo '<tr> 
                                            <td>'.$row['workerId'].'</td> 
                                            <td>'.$fullname.'</td> 
                                            <td>'.$row['department'].'</td> 
                                            <td>'.$row['role'].'</td>
                                            <td>'.$row['basePay'].'</td>
                                            <td>'.$row['overtimeRate'].'</td> 
                                        </tr>';
                                }

                    }
                    $result->close();
            ?>

        </tbody>
    </table>
</div>


<div class="top-bar">
    <h3 class="section-title" id="payroll-tab" onclick="employeeWord()">Pay Slips</h3>
</div>
<div class="table-container">


      <table class="payslip-table">
            <thead>
                <tr>
                    <th>Slip ID</th>
                    <th>Name</th>
                    <th>date</th>
                    <th>Gross Pa</th>
                    <th>income tax </th>
                    <th>insurance Rate</th>
                    <th>contribution</th>
                    <th>net pay</th>
                </tr>
            </thead>
            <tbody>
<?php
$grabslips = "SELECT payslipid,workerid,date,grossPay,incomeTax,insurance,contribution,netPay FROM payslips";

         if ($result = $conn->query($grabslips)) {
                    while ($row = $result->fetch_assoc()) {
                            $stmt = $conn->prepare("SELECT firstName, lastName FROM workers WHERE workerId = ?");
                            $stmt->bind_param("i", $row['workerid'],);
                            $stmt->execute();
                            $stmt->store_result();
                            $stmt->bind_result($firstname,$lastname);
                            $stmt->fetch();
                            $fullname = $firstname.$lastname;
                            $stmt->close();
                        echo '<tr> 
                                  <td>'.$row['payslipid'].'</td> 
                                  <td>'.$fullname.'</td> 
                                  <td>'.$row['date'].'</td> 
                                  <td>'.$row['grossPay'].'</td>
                                  <td>'.$row['incomeTax'].'</td>
                                  <td>'.$row['insurance'].'</td> 
                                  <td>'.$row['contribution'].'</td> 
                                  <td>'.$row['netPay'].'</td> 
                            </tr>';
                    }

        }
        $result->close();
?>
            </tbody>
        </table>
</div>

<div class="top-bar">
    <h3 class="section-title" id="payroll-tab" onclick="employeeWord()">Make Pay slip</h3>
</div>
<div class="table-container">
    <div class="form-container">
        <form method="post" action="includes/insertpayslip.php">
            <input type="number" name="workerid" id="workerid">
            <label for="workerid">Worker ID</label>
            <br>
            <input type="number" name="hours" id="hours">
            <label for="workedhours">Hours Worked</label>
            <br>
            <input type="number" name="overtimehours" id="overtimehours">
            <label for="workedovertime">Overtime Hours</label>
            <br>
            <input type="submit" value="Submit">
        </form>
    </div>
</div>
