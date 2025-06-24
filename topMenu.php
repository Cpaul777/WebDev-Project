<?php
include 'includes/db_connect.php';

if(!isset($_SESSION)) session_start();

if(!isset($_SESSION['email'])){
  header("Location: login.php");
  exit();
}

$id= $_SESSION['workerid'];
$conn->close();

?>

<style>
    :root {
            --top-bar-height: 60px;
            --white-color: #ffffff;
            --dark-color: #333333;
            --very-light-green: #bfffc2;
            --green: #008F05;
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
            font-size: 1.2rem;
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
            cursor: pointer;
        }

        .top-menu .right .profile-pic i {
            font-size: 20px;
            color: var(--green);
        }

        .profile-drop-down {
            display: none;
            position: absolute;
            top: calc(var(--top-bar-height) + 10px);
            right: 20px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 250px;
            z-index: 200;
            padding: 8px 0;
        }


</style>

<div class="top-menu">
        <a href="employeepage.php"><i class="bi bi-layout-three-columns"></i>Las Piñas Information System Portal</a>
        <div class="right">
        <span>June 18, 2025<br><small>Wednesday</small></span>
        <div class="profile-pic" id="profile-button" onclick="profileDropDown()">
            <i class="bi bi-person"></i>
        </div>
    </div>

    <div class="profile-drop-down" id="profile-drop-down">
        <div style="padding: 12px 16px; border-bottom: 1px solid #e5e7eb;">
            <p style="font-weight: 500; color: #111827;"><?php echo $_SESSION['firstname']," ",$_SESSION['lastname'] ;?></p>
            <p style="font-size: 12px; color: #6b7280;">Administrator</p>
        </div>
        <a href="employeeinfo.php" style="display: block; padding: 12px 16px; text-decoration: none; color: #374151; font-size: 14px; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='transparent'">Profile Settings</a>
        <a href="hr_helpdesk.php" style="display: block; padding: 12px 16px; text-decoration: none; color: #374151; font-size: 14px; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='transparent'">Help & Support</a>
        <hr style="margin: 8px 0; border: none; border-top: 1px solid #e5e7eb;">
        <a href="logout.php" style="display: block; padding: 12px 16px; text-decoration: none; color: #dc2626; font-size: 14px; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='transparent'">Sign Out</a>
    </div>
</div>
<script>
    function profileDropDown(){
    const dropDown = document.getElementById('profile-drop-down');
    if(dropDown.style.display == 'block'){
        document.getElementById('profile-drop-down').style.display = 'none';
    } else{ 
        document.getElementById('profile-drop-down').style.display = 'block';
    }
}

</script>