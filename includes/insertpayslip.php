<?php
var_dump($_POST);
include 'db_connect.php';
session_start();

// Check if the user is logged in, if
// not then redirect them to the login page
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
} 

if (!($_SESSION['role'] == 'administrator') && !($_SESSION['role'] == 'Administrator')) {
    echo 'it entered here?';
    header("Location: employeePage.php");
    exit();
}

$checkrateStmt = $conn->prepare("SELECT basePay,overtimeRate FROM workers WHERE workerId = ?");
$checkrateStmt->bind_param("s", $_POST['workerid']);
$checkrateStmt->execute();
$checkrateStmt->bind_result($basepay,$overtimerate);
$checkrateStmt->fetch();
$checkrateStmt->close();
$date = date('Y-m-d');
$id = $_POST['workerid'];
$hours = $_POST['hours'];
$overtimehours = $_POST['overtimehours'];
$grosspay = ($hours*$basepay)+($overtimehours*$basepay*$overtimerate);
$incometax = $grosspay*.2;
$insurance = $grosspay*.1;
$contribution = $grosspay*.1;
if($contribution > 2000){
    $contribution = 2000;
}
        $netpay = $grosspay-($incometax+$insurance+$contribution);
        $stmt = $conn->prepare("INSERT INTO payslips (workerid, grosspay,date, incometax,insurance,contribution,netpay) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("idsdddd", $id,$grosspay, $date,$incometax,$insurance,$contribution,$netpay);
        if($stmt->execute()){
        $state = "Payslip successfully generated";
        }
        else{
        $state = "Payslip failed to generate, report this to admin immediately";
        }
        $stmt->close();

    echo '<script>
    alert("'.$state.' ");
    window.location.href = "../index.php?tab=includes/payroll.php";
    </script>';
    exit;

    

 

?>