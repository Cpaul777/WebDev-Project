<?php
include 'db_connect.php';
session_start();
$message = "";

if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_POST['id'])){
    echo '<script>
    alert("User Data Deleted");
    window.location.href = "../index.php?tab=includes/employees.php&page=1";
    </script>';
    exit;
}

$gender_query = "SELECT DISTINCT gender FROM workers";
$gender_result = mysqli_query($conn, $gender_query);
$genders = [];
while ($row = mysqli_fetch_assoc($gender_result)) {
    $genders[] = $row['gender'];
}

$dept_query = "SELECT DISTINCT department FROM workers";
$dept_result = mysqli_query($conn, $dept_query);
$departments = [];
while ($row = mysqli_fetch_assoc($dept_result)) {
    $departments[] = $row['department'];
}

$role_query = "SELECT DISTINCT role FROM workers";
$role_result = mysqli_query($conn, $role_query);
$roles = [];
while ($row = mysqli_fetch_assoc($role_result)) {
    $roles[] = $row['role'];
}

$id = $_POST['id'];
if(isset($_POST['newfirstname'])){
    $newfirstname = $_POST['newfirstname'];
    $newlastname = $_POST['newlastname'];
    $emailid = $_POST['emailid'];
    $newemail = $_POST['newemail'];
    $newgender = $_POST['newgender'];
    $newrole = $_POST['newrole'];
    $newdepartment = $_POST['newdepartment'];

    $updatestmt = $conn->prepare("UPDATE workers SET firstName = ?,lastName = ?, role = ? , Gender = ?, department = ? WHERE workerId = $id");
    $updatestmt->bind_param("sssss", $newfirstname, $newlastname, $newrole, $newgender, $newdepartment);
    $updatestmt->execute();
    $updatestmt = $conn->prepare("UPDATE users SET  email = ? WHERE userid = $emailid");
    $updatestmt->bind_param("s",  $newemail);
      if ($updatestmt->execute()) {
          $message = "successfully altered entry";
            echo '<script>
            window.location.href = "../index.php?tab=includes/employees.php&page=1";
            </script>';
        } else {
          $message = "Error: " . $stmt->error;
      }
}

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../styles/editEmployee.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Manage Employee</h1>
            <p>Edit Employee Details</p>
        </header>
        
        <div class="content">
            <div class="status-bar <?php echo $conn ? 'status-connected' : 'status-disconnected'; ?>">
                <span>Database Status:</span>
                <span>
                    <?php 
                    if ($conn) {
                        echo '<i class="fas fa-check-circle"></i> Connected';
                    } else {
                        echo '<i class="fas fa-times-circle"></i> Not Connected';
                    }
                    ?>
                </span>
            </div>
            
            <div class="employee-info-grid">
                <div class="info-card">
                    <div class="info-label">Employee ID</div>
                    <div class="info-value"><?php echo $id; ?></div>
                </div>
                <div class="info-card">
                    <div class="info-label">First Name</div>
                    <div class="info-value"><?php echo $firstname;?></div>
                </div>
                <div class="info-card">
                    <div class="info-label">Last Name</div>
                    <div class="info-value"><?php echo htmlspecialchars($lastname); ?></div>
                </div>
                <div class="info-card">
                    <div class="info-label">Email</div>
                    <div class="info-value"><?php echo htmlspecialchars($email); ?></div>
                </div>
                <div class="info-card">
                    <div class="info-label">Role</div>
                    <div class="info-value"><?php echo htmlspecialchars($role); ?></div>
                </div>
                <div class="info-card">
                    <div class="info-label">Gender</div>
                    <div class="info-value"><?php echo htmlspecialchars($gender); ?></div>
                </div>
                <div class="info-card">
                    <div class="info-label">Department</div>
                    <div class="info-value"><?php echo htmlspecialchars($department); ?></div>
                </div>
            </div>
            
            <div class="edit-form">
                <div class="form-header">
                    <h2><i class="fas fa-user-edit"></i> Update Employee Information</h2>
                </div>
                
                <form method="post">
                    <div class="form-grid">
                        <div class="input-group">
                            <label for="newfirstname">First Name</label>
                            <input type="text" name="newfirstname" value="<?php echo $firstname?>">
                        </div>
                        
                        <div class="input-group">
                            <label for="newlastname">Last Name</label>
                            <input type="text" name="newlastname" value="<?php echo $lastname?>">
                        </div>
                        
                        <div class="input-group">
                            <label for="newemail">Email</label>
                            <input type="email" name="newemail" value="<?php echo $email?>">
                        </div>
                        
                        <div class="input-group">
                            <label for="roles">Role</label>
                            <select class="filter-select" name="newrole" id="roles">
                                <?php foreach($roles as $roleSelect): ?>
                                <option value="<?= $roleSelect?>" <?= $role === $roleSelect ? 'selected' : '' ?> > <?= $roleSelect ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        
                        <div class="input-group">
                            <label for="genders">Gender</label>
                            <select class="filter-select" name="newgender" id="genders">
                                <?php foreach($genders as $genderSelect): ?>
                                <option value="<?= $genderSelect?>" <?= $gender === $genderSelect ? 'selected' : '' ?> > <?= $genderSelect ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        
                        <div class="input-group">
                            <label for="department">Choose Department:</label>
                            <select class="filter-select" name="newdepartment" id="department">
                                <?php foreach($departments as $dept): ?>
                                <option value="<?= $dept?>" <?= $department === $dept ? 'selected' : '' ?> > <?= $dept ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    
                    <input type="hidden" name="id" value="<?php echo $id;?>" />
                    <input type="hidden" name="emailid" value="<?php echo $emailid;?>" />
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-submit">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </form>
                
                <?php if ($message): ?>
                    <div class="message <?php echo strpos($message, 'success') !== false ? 'message-success' : 'message-error'; ?>">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>