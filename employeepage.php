<?php 


include 'includes/db_connect.php';

if(!isset($_SESSION)) session_start();

if(!isset($_SESSION['email'])){
  header("Location: login.php");
  exit();
}

$id= $_SESSION['workerid'];

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
    <title><?=$firstname?>'s Page</title>
    <link rel="stylesheet" href="styles/employeepage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>

        :root {
            --top-bar-height: 60px;
            --white-color: #ffffff;
            --dark-color: #333333;
            --very-light-green: #bfffc2;
            --green: #008F05;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
            color: #1f2937;
        }

        .top-menu {
            height: var(--top-bar-height);
            background-color: var(--green);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            z-index: 100;
            position: sticky;
            top: 0;
        }

            .top-menu a {
            color: var(--white-color);
            text-decoration: none;
            margin-left: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

            .top-menu .right {
            color: var(--white-color);
            display: flex;
            align-items: center;
            gap: 20px;
            font-size: 14px;
            text-align: right;
        }

            .top-menu .right .profile-pic {
            width: 40px;
            height: 40px;
            background: var(--white-color);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

            .top-menu .right .profile-pic i {
            font-size: 20px;
            color: var(--green);
        }


        .main-section {
            width: 1000px;
            max-width: 1500px;
            margin: 0 auto;
            padding: 20px;
        }

        .welcome-banner {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.07);
            margin: 32px auto 24px auto;
            max-width: 1000px;
            padding: 0 0 24px 0;
        }

        .welcome-banner h2 {
            color: #008F05;
            font-size: 2rem;
            font-weight: 700;
            padding: 24px 32px 0 32px;
            margin-bottom: 0;
        }
        .profile-summary {
            background: #f3f7fa;
            border-radius: 10px;
            margin: 18px 32px 0 32px;
            padding: 18px 24px 18px 24px;
            display: flex;
            align-items: center;
            gap: 32px;
        }
        .profile-summary .avatar {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            background: #e5f5e5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            font-weight: 700;
            color: #008F05;
        }
        .profile-summary .profile-details {
            flex: 1;
        }
        .profile-summary .profile-details strong {
            font-size: 1.2rem;
            color: #222;
            font-weight: 600;
        }
        .profile-summary .profile-details .meta {
            font-size: 0.97rem;
            color: #4A9C4D;
            margin-top: 2px;
        }
        .profile-summary .profile-details .meta span {
            display: block;
        }

        .profile-summary .pic-status {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .profile-summary .status {
            color: #00c81b;
            font-size: 1rem;
            font-weight: 600;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .quick-access {
            margin: 32px auto 0 auto;
            max-width: 1000px;
        }

        .quick-access h3 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: #222;
        }

        .quick-access-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 16px;
            margin-bottom: 18px;
            max-width: 1000px;
        }

        .quick-access-tile {
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-width: 120px;
            cursor: pointer;
            transition: box-shadow 0.2s, background 0.2s;
        }
        .quick-access-tile:hover {
            box-shadow: 0 2px 12px rgba(0,143,5,0.08);
        }

        .quick-access h3{
            font-size: 1.5rem;
            font-weight: 600;
        }

        .quick-access-tile img {
            width: 185px;
            height: 120px;
            margin-bottom: 8px;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.2s;
        }

        .quick-access-tile img:hover {
            transform: scale(1.05);
            box-shadow: 0 2px 12px rgba(0,143,5,0.1);
        }


        .quick-access-tile span {
            font-size: 1.1rem;
            color: #222;
            font-weight: 570;
            text-align: center;
        }

        .quick-access-tile:hover span {
            color: #008F05;
        }

        .notice-board {
            margin: 32px auto 0 auto;
            max-width: 1000px;
        }
        .notice-board h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 6px;
            color: #222;
        }
        .notice-board p {
            color: #444;
            font-size: 1rem;
            margin-bottom: 12px;
        }
        .notice-board .notice {
            display: flex;
            gap: 18px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
            padding: 16px 18px;
            align-items: flex-start;
        }
        .notice-board .notice img {
            width: 475px;
            height: 250px;
            object-fit: cover;
            border-radius: 8px;
        }
        .notice-board .notice .notice-content {
            flex: 1;
        }
        .notice-board .notice .notice-content .notice-title {
            font-weight: 500;
            color: #6E8566;
            font-size: 1.05rem;
            margin-bottom: 2px;
        }
        .notice-board .notice .notice-content .notice-headline {
            font-weight: 600;
            color: #222;
            font-size: 1.01rem;
            margin-bottom: 2px;
        }
        .notice-board .notice .notice-content .notice-desc {
            color: #444;
            font-size: 0.97rem;
        }
        .resources {
           margin: 32px auto 0 auto;
            max-width: 1000px;
        }
        .resources h3 {
            font-size: 1.5rem;
            font-weight: 600;
        }
        .resources-grid {
            display: flex;
            gap: 18px;
        }
        .resource-tile {
            flex: 1;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 18px 0 10px 0;
            min-width: 120px;
            cursor: pointer;
            transition: box-shadow 0.2s, background 0.2s;
        }
        .resource-tile:hover {
            box-shadow: 0 2px 12px rgba(0,143,5,0.08);
        }
        .resource-tile img {
            width: 185px;
            height: 120px;
            margin-bottom: 8px;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.2s;
        }

        .resource-tile img:hover {
            transform: scale(1.05);
            box-shadow: 0 2px 12px rgba(0,143,5,0.1);
        }

        .resource-tile span {
            font-size: 1.1rem;
            color: #222;
            font-weight: 570;
            text-align: center;
        }

        .resource-tile:hover span {
            color: #008F05;
        }

        @media (max-width: 900px) {
            .quick-access-grid, .resources-grid {
                flex-direction: column;
                gap: 12px;
            }
            .welcome-banner, .notice-board {
                max-width: 98vw;
            }
        }
    </style>
</head>
<body>
    <div class="top-menu">
    <a href="#"><i class="bi bi-layout-three-columns"></i>Las Piñas Information System Portal</a>
    <div class="right">
      <span>June 18, 2025<br><small>Wednesday</small></span>
      <div class="profile-pic" id="profile-button" onclick="profileDropDown()">
        <i class="bi bi-person"></i>
      </div>
    </div>
  </div>
    <div class="main-section">
         <div class="welcome-banner">
        <h2>Welcome Back, <?php echo $firstname; ?>!</h2>
        <div class="profile-summary">
            <div class="pic-status">
                <div class="avatar"><!-- profile image here --></div>
                <span class="status"><span style="font-size:1.1em;">●</span> Active</span>
            </div>
            <div class="profile-details">
                <strong><?php echo $firstname . ' ' . $lastname; ?></strong><br>
                <span class="meta"><b>Employee ID: </b> LP-2024-0001</span><br>
                <span class="meta"><b>Department: </b> <?php echo $department; ?></span><br>
                <span class="meta"><b>Position: </b><?= $role?></span><br>
            </div>
        </div>
    </div>
    
    <div class="quick-access">
        <h3>Quick Access</h3>
        <div class="quick-access-grid">
            <a href="hr_announcements.php" style="text-decoration:none; color:inherit;">
                <div class="quick-access-tile"><img src="img/announcements.png" alt="HR Announcements"><span>HR Announcements</span>
                </div>
            </a>

             <a href="" style="text-decoration:none; color:inherit;">
                <div class="quick-access-tile">                
                    <img src="img/time_wa.png" alt="Time In / Time Out"><span>Time In / Time Out</span>
                </div>
            </a>
            
            <a href="employeeInfo.php?tab=general" style="text-decoration:none; color:inherit;">
                <div class="quick-access-tile">        
                    <img src="img/gen_info.png" alt="General    Information"><span>General Information</span>
                </div>
            </a>


            <a href="employeeInfo.php?tab=payslip" style="text-decoration:none; color:inherit;">
                <div class="quick-access-tile">
                    <img src="img/payslip.png" alt="Payslip"><span>Payslip</span>
                </div>
            </a>

            <a href="employeeInfo.php?tab=leavereq" style="text-decoration:none; color:inherit;">
                <div class="quick-access-tile">
                    <img src="img/leave_form.png" alt="Leave Form"><span>Leave Form</span>
                </div>
            </a>    
        </div>
    </div>
    <div class="notice-board">
        <h3>Notice Board</h3>
        <p>Stay updated with the latest news and important announcements from the Local Government.</p>
        <div class="notice">
            <img src="img/news_article.jpg" alt="Job Fair">
            <div class="notice-content">
                <div class="notice-title">Job Fair in Las Piñas</div>
                <div class="notice-headline">Exciting Opportunity: We're Hiring in Las Piñas!</div>
                <div class="notice-desc">
                    We're excited to announce our upcoming Job Fair in Las Piñas! This event is a great chance to explore career opportunities and meet our team in person. Whether you're a fresh graduate or an experienced professional, we welcome you to join us on July 5th and take the next step in your career journey. See you there!
                </div>
            </div>
        </div>
    </div>
    <div class="resources">
        <h3>Resources</h3>
        <div class="resources-grid">
            <a href="code_of_conduct.php" style="text-decoration:none; color:inherit;"><div class="resource-tile"><img src="img/comp_policy.png" alt="Code of Conduct Policy"><span>Code of Conduct Policy</span></div></a>
            <a href="training_materials.php" style="text-decoration:none; color:inherit;"><div class="resource-tile"><img src="img/training_logo.png" alt="Training Materials"><span>Training Materials</span></div></a>
            <a href="hr_helpdesk.php" style="text-decoration:none; color:inherit;"><div class="resource-tile"><img src="img/hr_helpdesk.png" alt="HR Help Desk"><span>HR Help Desk</span></div></a>
        </div>
    </div>
    </div>
   
</body>
</html>