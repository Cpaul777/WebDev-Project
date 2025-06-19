<?php

include 'includes/db_connect.php';
session_start();

if(isset($_GET['jobid'])) {
    $jobid = $_GET['jobid'];
} else {
    echo "<script>alert('No job ID provided.');</script>";
    header("Location: jobs.php");
    exit();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="jobs.css">
</head>
<body>
    <div class="top-menu">
         <div class="las-pinas">
            <i class="bi bi-bank2"></i>
            <h2> Las Piñas Job Portal</h2>
         </div>
         <div class="tabs">
            <ul>
                <li><a href="jportal.php">Home</a></li>
                <li><a href="jobs.php" class="active">Jobs</a></li>
                <li><a href="about.php" >About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
         </div>
        
         <div class="right-side">
            <button class="sign-btn" id="sign-up">Sign Up</button>
            <button class="login-btn" id="login-btn">Login</button>
         </div>

    </div>
    <div class="main-section">
        <h2></h2>
        <p></p>

        <h3>Job Description</h3>
        <p></p>

        <h3>Responsibilities</h3>


</body>
</html>