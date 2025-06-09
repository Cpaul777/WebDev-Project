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
if($_GET['action'] == 'accept'){
    $state = 'Accepted';
}

if($_GET['action'] == 'reject'){
    $state = 'Rejected';
}
    $Stmt = $conn->prepare("UPDATE leaves SET status = ? WHERE itemid = ?");
    $Stmt->bind_param("si",$state, $id,);
    $Stmt->execute();

    

    echo '<script>
    alert("Leave'.$state.' ");
    window.location.href = "../index.php?tab=includes/getleaves.php";
    </script>';
    exit;

    // header("Refresh: 1; URL=../index.php?tab=includes%2Femployees.php&page=1"); 
    // header("Refresh: 1; URL=../index.php/");
    ?>
