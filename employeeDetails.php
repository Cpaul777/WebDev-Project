<?php 

include 'includes/db_connect.php';

if(!isset($_SESSION)) session_start();

if(!isset($_SESSION['email'])){
  header("Location: login.php");
  exit();
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT firstName, lastName, emailId, role, gender, department FROM workers WHERE workerId = ?");
    $stmt->bind_param("i", $id,);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($firstname, $lastname, $emailid, $role, $gender, $department);
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

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($lastname);?>'s Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <style>
    body{
      background-color: #F8F8F8;
      font-family: "Poppins", sans-serif;
      display: flex;  
      flex-direction: column;
      overflow: auto;
    }
    
    .back-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 20px;
      margin: 20px; 
      font-size: 16px;
      font-weight: bold;
      text-align: center;
      text-decoration: none; 
      color: #ffffff; 
      background-color: #5FC903; 
      border: 1px solid #5FC903; 
      border-radius: 5px; 
      cursor: pointer; 
      transition: background-color 0.3s ease, border-color 0.3s ease; 
    }

    .back-btn svg {
      width: 20px;
      height: 20px;
      fill: none;
      stroke: white;
      stroke-width: 2;
      stroke-linecap: round;
      stroke-linejoin: round;
    }

    .back-btn:hover{
      background-color: #008F05;
      border-color: #008F05;
    }
    .back-btn:active{
      background-color: #006d04;
      border-color: #006d04;
    }
    .container {
      margin-left: 0;
      padding: 1.5rem;
      padding-top: 1.3rem;
    }
    .profile-card {
      background: white;
      width: 220px;
      padding: 1.5rem;
     box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      border-radius: 10px;
      text-align: left;
      font-weight: 500;
    }
    .profile-card .pic-hold{
      position: relative;
      width: 80px;
      height: 80px;
      margin: auto;
      margin-bottom: 12px;
      border-radius: 50%;
      background-color: #008F05;
      border: 1px solid #0af312;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .profile-card .placeholder-icon {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 55px;
      color: #ffffff;
      cursor: pointer;
    }
    .profile-card h3 {
      text-align: center;
      margin: 0 0 0.2rem 0;
      font-weight: 600;
    }
    .profile-card p.role {
      text-align: center;
      margin: 0 0 0.5rem 0;
      color: gray;
      font-weight: 400;
    }
    .profile-card p.status {
      text-align: center;
      color: green;
      font-size: 0.9rem;
      font-weight: 600;
      margin: 0 0 1rem 0;
    }
    .profile-info-block {
      margin-bottom: 1rem;
      font-size: 0.9rem;
    }
    .profile-info-block small {
      font-weight: 700;
      color: gray;
      display: block;
      margin-bottom: 0.5rem;
      font-size: 13px;
    }
    .profile-info-block span, .profile-info-block div {
      font-weight: 600;
      color: #333;
    }
    .profile-info-inline {
      display: flex;
      align-items: center;
      font-weight: 600;
      color: #333;
    }
    .profile-info-inline span {
      margin-right: 0.5rem;
      font-size: 1rem;
    }
    .tab-box {
      background: white;
      margin-left: 1.5rem;
      flex: 1;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    .tabs {
      display: flex;
      border-bottom: 1px solid #ccc;
      font-weight: 600;
      text-align: center;
      justify-content: center;
      background-color:#008F05 ;
      color: white;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
    }
    .tabs .general{
      padding: 1rem;
      font-size: 1.2rem;
    }
    /* .tabs .active {
      border-bottom: 3px solid #000;
      font-weight: 700;
    } */


    .info-section {
      padding: 1rem;
      font-weight: 400;
      font-size: 0.9rem;
      color: #222;
    }
    .card {
      background: #fff;
      padding: 1rem;
      border-radius: 10px;
      margin-bottom: 1rem;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    .card h3 {
      font-size: 1.15rem;
      margin-bottom: 0.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-weight: 600;
      color: #0c7b14;
    }
    .card .edit {
      color: #0c7b14;
      cursor: pointer;
      font-weight: 500;
      font-size: 0.9rem;
    }
    .info-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      row-gap: 0.6rem;
      column-gap: 2rem;
    }
    .row {
      font-weight: 400;
      color: #333;
      font-size: 0.9rem;
    }
    .row small {
      font-weight: 500;
      color: gray;
      margin-right: 0.4rem;
      font-size: .95rem;
    }
    .row strong {
      font-weight: 700;
      font-size: 1rem;

    }
    .header-row {
      display: flex;
      align-items: center;
      justify-content: flex-start;
      margin-bottom: 1rem;

    }
    .header-row div {
      color: black;
      font-weight: 600;
      font-size: 1.1rem;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      user-select: none;
    }
    
    .main-content {
      display: flex;
      gap: .5rem;
      margin:auto;
      padding: 8px;
    }
    </style>
</head>
<body>
    <div class="container">
    <div class="header-row">
      <div class="whole-back-btn">
        <a class="back-btn" href="../index.php?tab=includes/employees.php&page=1">
          <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
            <path d="M15 18l-6-6 6-6" />
          </svg>Details
        </a>
      </div>
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
      </div>

      <div class="tab-box">
        <div class="tabs">
          <div class="general active">General Information</div>
        </div>
        <!--  -->
        <div class="info-section">
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
      </div>
    </div>
  </div>
  <script></script>
</body>
</html>
