<?php
include '../includes/db_connect.php';
session_start();



// Check if the user is logged in, if
// not then redirect them to the login page


// Grab da shit you need from jobs table
$sql = "SELECT * FROM jobs";
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
        
         <!-- <div class="right-side">
            <button class="sign-btn" id="sign-up">Sign Up</button>
            <button class="login-btn" id="login-btn">Login</button>
         </div> -->

    </div>

    <div class="main-section">
        <h1>Jobs Available</h1>
        <p>Explore current job opportunities within the local government.</p>
        <div class="job-filters">
            <button type="button">Department <i class="bi bi-chevron-down"></i></button>
            <button type="button">Location <i class="bi bi-chevron-down"></i></button>
            <button type="button">Category <i class="bi bi-chevron-down"></i></button>
        </div>
        <div class="job-table-container">
        <table class="job-table">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Department</th>
                    <th>Location</th>
                    <th>Category</th>
                    <th>Closing Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result = $conn->query($sql)) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr> 
                                            <td class="job-title"><a href="job_details.php?job_id='.$row['jobid'].'">'.$row['role'].'</a></td>
                                            <td class="department">'.$row['department'].'</td> 
                                            <td>'.$row['location'].'</td>
                                            <td><span>'.$row['category'].'</span></td>
                                            <td>'.$row['closingdate'].'</td>
                                        </tr>';
                                }
                    }
                    $result->close(); 
                ?>

                
            </tbody>
        </table>
        </div>
    </div>
    <footer>
        <div class="footer-links">
            <ul>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="privacy.php">Privacy Policy</a></li>
                <li><a href="terms.php">Terms of Service</a></li>

            </ul>
        </div>
        <p>&copy;2024 Las Pinas Job Portal. All rights reserved.</p>
    </footer>
</body>
</html>






<!--  -->

