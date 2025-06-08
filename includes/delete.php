<?php
include 'db_connect.php';
session_start();

// Check if the user is logged in, if
// not then redirect them to the login page
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
    $getOtherStmt = $conn->prepare("SELECT emailID FROM workers WHERE workerId = ?");
    $getOtherStmt->bind_param("i", $id,);
    $getOtherStmt->execute();
    $getOtherStmt->store_result();
    $getOtherStmt->bind_result($emailid);
    $getOtherStmt->fetch();
    
    $deleteLeaveStmt = $conn->prepare("DELETE FROM leaves WHERE authorid = ?");
    $deleteLeaveStmt->bind_param("i", $id);
    $deleteLeaveStmt->execute();
    $deleteLeaveStmt->store_result();
    
    $deleteWorkerInfoStmt = $conn->prepare("DELETE FROM workers WHERE workerId = ?");
    $deleteWorkerInfoStmt->bind_param("i", $id);
    $deleteWorkerInfoStmt->execute();
    $deleteWorkerInfoStmt->store_result();

    $deleteAccountInfoStmt = $conn->prepare("DELETE FROM users WHERE userid = ?");
    $deleteAccountInfoStmt->bind_param("i", $emailid);
    $deleteAccountInfoStmt->execute();
    $deleteAccountInfoStmt->store_result();

    echo '<script>
    alert("User Data Deleted");
    window.location.href = "../index.php?tab=includes/employees.php&page=1";
    </script>';
    exit;

    // header("Refresh: 1; URL=../index.php?tab=includes%2Femployees.php&page=1"); 
    // header("Refresh: 1; URL=../index.php/");
    ?>
