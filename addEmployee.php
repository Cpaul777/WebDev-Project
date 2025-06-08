<?php
include 'includes/db_connect.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $role = ($_POST['role']);
    $dept = ($_POST['department']);
    $gender = $_POST['gender'];
    $password = '1234';
    $usertype = 'student';

    $salt = bin2hex(random_bytes(16));
    $passwordsalted = $password . $salt;
    $passwordhashed = password_hash($passwordsalted, PASSWORD_BCRYPT);

    // Check if email already exists
    $checkEmailStmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $checkEmailStmt->store_result();

    if ($checkEmailStmt->num_rows > 0) {
        $message = "Email ID already exists in database, contact HR for help.";
    }else {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO users (email, hashedpassword, salt) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email,$passwordhashed, $salt);
        if ($stmt->execute()) {
            $message = "Account created successfully";
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
        // get the email id we just created
            $getEmailStmt = $conn->prepare("SELECT userid FROM users WHERE email = ?");
            $getEmailStmt->bind_param("s", $email);
            $getEmailStmt->execute();
            $resultemail = $getEmailStmt->get_result();
            $emailid = $resultemail->fetch_assoc();
            $date = date('Y-m-d');
        $createworkerstmt = $conn->prepare("INSERT INTO workers (firstName,lastName,emailId,role,department,gender,hireDate) VALUES (?, ?, ?, ?, ?, ? ,?)");
        $createworkerstmt->bind_param( "ssissss", $firstname, $lastname, $emailid['userid'],$role,$dept,$gender,$date);
        if ($createworkerstmt->execute()) {
            $message = "Account created successfully";
            echo '<script> alert("'.$message.'") ;
                    window.location.href = "../index.php?tab=includes/employees.php&page=1";
                </script>';

        } else {
            $message = "Error: " . $stmt->error;
        }
        $createworkerstmt->close();
    }
    $checkEmailStmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Employee</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #e8f5e9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .add-container {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            padding: 35px 30px;
            width: 360px;
            text-align: center;
        }

        .add-container h2 {
            color: #2e7d32;
            margin-bottom: 25px;
            font-size: 26px;
        }

        .add-container label {
            display: block;
            text-align: left;
            margin-top: 15px;
            font-weight: 500;
            font-size: 14px;
            color: #333;
        }

        .add-container input[type="text"],
        .add-container input[type="password"],
        .add-container input[type="email"],
        .add-container select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .add-container button[type="submit"],
        .add-container input[type="reset"] {
            background-color: #2e7d32;
            color: #ffffff;
            padding: 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 20px;
            width: 100%;
            font-size: 16px;
        }

        .add-container button[type="submit"]:hover,
        .add-container input[type="reset"]:hover {
            background-color: #1b5e20;
        }

        .add-container .message {
            margin-bottom: 15px;
            font-size: 14px;
            color: #e53935;
        }

        .add-container .success {
            color: #2e7d32;
        }
    </style>
</head>
<body>
    <div class="add-container">
        <h2>Add Employee</h2>

        <p class="message <?php echo ($message == "Account created successfully") ? 'success' : ''; ?>">
            <?php echo htmlspecialchars($message); ?>
        </p>

        <form method="post">
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" id="firstname" required>

            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" id="lastname" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="role">Role</label>
            <select name="role" id="role" required>
                <option value="">Select Role</option>
                <option value="Punong Barangay">Punong Barangay</option>
                <option value="Secretary">Secretary</option>
                <option value="Treasurer">Treasurer</option>
                <option value="Clerk">Clerk</option>
                <option value="Councilor">Councilor</option>
                <option value="Sk Chairperson">Sk Chairperson</option>
                <option value="Sk Kagawad">Sk Kagawad</option>
                <option value="Health Workers">Health Workers</option>
                <option value="Nutrition Scholar">Nutrition Scholar</option>
                <option value="Day Care Worker">Day Care Worker</option>
                <option value="Utility Maintenance Worker">Utility Maintenance Worker</option>
            </select>

            <label for="gender">Gender</label>
            <select name="gender" id="gender" required>
                <option value="">Select Gender</option>
                <option value="MALE">Male</option>
                <option value="FEMALE">Female</option>
                <option value="OTHER">Other</option>
            </select>

            <label for="department">Department</label>
            <select name="department" id="department" required>
                <option value="">Select Department</option>
                <option value="Legislative">Legislative</option>
                <option value="Administration">Administration</option>
                <option value="Safety & Health Services">Safety & Health Services</option>
                <option value="Sangguniang Kabataan">Sangguniang Kabataan</option>
            </select>

            <button type="submit" name="submit">Add</button>
            <input type="reset" value="Reset">
        </form>
    </div>
</body>
</html>