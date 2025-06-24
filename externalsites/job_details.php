<?php

include '../includes/db_connect.php';
session_start();

if(isset($_GET['job_id'])) {
    $jobid = $_GET['job_id'];
} else {
    echo "<script>alert('No job ID provided.');</script>";
    header("Location: jobs.php");
    exit();
}

$sql = "SELECT * FROM jobs WHERE jobid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $jobid); 
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
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
    <style>
        * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        }

        :root {
            --top-bar-height: 68px;
            --dark-green:#008F05;
            --light-green:#00c81b;
            --very-light-green:#0af312;
            --bg-color:#F8F8F8;
            --dark-color:#333;
            --white-color:white;
            --other-white: #E5F5E5;
        }

        body{
            background-color: #F8F8F8;
            font-family: "Poppins", sans-serif;
            display: flex;
            flex-direction: column;
        }

        .top-menu {
            overflow: hidden;
            height: var(--top-bar-height);
            color: black;
            background-color:var(--white-color);
            display: flex;
            align-items: center;
            padding: 0 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            z-index: 100;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .top-menu .las-pinas{
            display: flex;
            align-items: center;
            gap: 15px;
            margin-right: 27px;
        }

        .top-menu .las-pinas i {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dark-color);
            vertical-align: middle;
        }

        .top-menu .las-pinas h2{
            font-size: 1.5rem;
            font-weight: 650;
            color: var(--dark-color);
            margin-left: 10px;
        }

        .top-menu ul{
            list-style: none;
            display: flex;
            height: 50px;
            align-items: center;
            margin: 0;
        }

        .top-menu ul li {
            width: 100%;
            height: auto;
            text-align: center;
            display: inline-block;
            position: relative;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }

        .top-menu ul li:hover{
            color: var(--dark-green);
            background-color: var(--bg-color);
            border-radius: 5px;
        }

        .top-menu ul li .active {
            color: var(--dark-green);
            background-color: var(--bg-color);
            border-radius: 5px;
        }

        .top-menu ul a:hover {
            color: var(--dark-green);
            background-color: var(--bg-color);
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .top-menu ul li a {
            color: black;
            text-decoration: none;
            font-size: large;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .top-menu .right-side {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-right: 12px;
        }

        /* Right side buttons */
        .top-menu .right-side button {
            background-color: var(--dark-green);
            color: var(--white-color);
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 700;
            transition: background-color 0.3s ease;
        }

        .top-menu .right-side .sign-btn:hover {
            background-color: var(--light-green);
        }
        .top-menu .right-side .login-btn:hover {
            background-color: #c4d2c4;
            color: var(--dark-color);
        }

        .top-menu .right-side .login-btn {
            background-color: var(--other-white);
            color: var(--dark-color);
            border: 1px solid var(--other-white);
            padding: 10px 20px;
        }

        .main-section {
            max-width: 1500px;
            margin: 32px auto 0 auto;
            padding: 34px 34px 34px 34px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
        }

        .main-section img {
            width: 100%;
            height: auto;
            border-radius: 16px;
            margin-bottom: 20px;
        }

        .main-section h1, .main-section h2 {
            color: #111;
        }
        .main-section h1 {
            font-size: 2.3rem;
            font-weight: 600;
            margin-bottom: 1.2rem;
        }
        .main-section h2 {
            font-size: 1.7rem;
            font-weight: 500;
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
        }
        .main-section p {
            font-size: 1.05rem;
            color: var(--dark-color);
            line-height: 1.6;
            margin-bottom: 18px;
        }
        
        .main-section ul{
            margin-left: 20px;
        }

        .main-section .closingdate{
            color: #008F05;
        }

        /* Apply Button */
        .main-section .apply-btn{
            background-color: var(--dark-green);
            color: var(--white-color);
            margin-top: 30px;
            border: none;
            padding: 15px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 700;
            transition: background-color 0.3s ease;
        }

        .main-section .apply-btn:hover{
             background-color: var(--light-green);
        }

        .back-btn-jobdetails {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            margin: 24px 0 18px 0;
            font-size: 1rem;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            color: #008F05;
            background-color: #e5f5e5;
            border: 1.5px solid #008F05;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.2s, border 0.2s;
        }
        .back-btn-jobdetails:hover {
            background-color: #008F05;
            color: #fff;
            border-color: #008F05;
        }

        /* FOOTER */
        footer{
            color: var(--light-green);
            text-align: center;
            justify-content: center;
        }

        footer p {
            font-size: 1rem;
            margin: 10px 0;
            font-weight: 600;
        }
        

        footer .footer-links {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap: 20px;
            padding: 20px;
            margin-bottom: 50px;
        }

        footer .footer-links ul{
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: row;
            gap: 150px;
        }

        footer .footer-links ul li{
            margin: 0 10px;
            display: inline-block;
            font-size: 1rem;
            margin: 0 10px;
        }

        footer .footer-links a{
            text-decoration: none;
            color: var(--light-green);
            font-weight: 500;
            transition: color 0.3s ease;
        }

        footer .footer-links a:hover {
            color: var(--dark-green);
            text-decoration: underline;
            text-shadow: 0 0 12px rgba(10, 243, 18, 0.28), 0 0 24px rgba(10, 243, 18, 0.18);
        }
    </style>
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
        <a href="jobs.php" class="back-btn-jobdetails">
            <svg viewBox="0 0 24 24" width="20" height="20" style="vertical-align:middle;margin-right:6px;">
                <path d="M15 18l-6-6 6-6" stroke="#008F05" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Back
        </a>
        <h1><?php echo $data['role'] ?></h1>
        <p class="closingdate"><?= $data['location'] .' - close in '. $data['closingdate'] ?></p>

        <h2>Job Description</h2>

        <p><?php echo $data['description'] ?></p>

        <?php 

            // $responsibilities = explode(";", $data['responsibilities']);
            
            // echo '<ul>';
            
            // foreach($responsibilities as $responsibility) {
            //     if(trim($responsibility) !== '') {
            //         echo "<li>" . htmlspecialchars($responsibility) . "</li>";
            //     }
            // }

            // echo '</ul>';
        ?>

        <h2>Qualifications</h2>
        <?php 

            $requirements = explode(";", $data['requirements']);
            
            
            echo '<ul>';
            
            foreach($requirements as $requirement) {
                if(trim($requirement) !== '') {
                    echo "<li>" . htmlspecialchars($requirement) . "</li>";
                }
            }

            echo '</ul>';
            
        ?>

        <form action="application_page.php" method="post">
            <input type="hidden" value="<?php echo $data['jobid'] ?>" name="jobid">
            <button class="apply-btn" type="submit" > Apply Now </button>
        </form>
    </div>
</body>
</html>