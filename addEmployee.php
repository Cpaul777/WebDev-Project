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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        body {
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
            background-color: #e8f5e9;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            height: 100vh;
        }
        
        .add-container {
            margin:auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            padding: 35px 30px;
            width: 60%;
            max-height: 90vh;
            overflow-y: auto;
            /* text-align: center; */
            padding-top: 5px;
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

        .header-row {
            display: flex;
            align-items: center;
           
        }

        .header-row h2 {
            margin: auto;
             margin-bottom: 25px;
            /* margin-top: 25px; */
        }


        .back-btn {
            display: inline-block;
            text-align: left;
            justify-self: left;
            gap: 8px;
            padding: 10px 20px;
            margin: 20px; 
            font-size: 16px;
            font-weight: bold;
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

        .add-container input[type="text"],
        .add-container input[type="password"],
        .add-container input[type="email"],
        .add-container input[type="date"],
        .add-container input[type="number"],
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
            margin-top: 10px;
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
        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        
        .form-group {
            display: flex;
            flex-direction: column;
        }

        form h3,
        form hr,
        form button,
        form input[type="reset"],
        form .message {
            grid-column: 1 / -1;
        }
    </style>
</head>
<body>
    <div class="add-container">
        <a class="back-btn" href="../index.php?tab=includes/employees.php&page=1">
                <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                <path d="M15 18l-6-6 6-6" />
                </svg>
                Back
            </a>
        <div class="header-row">
            <h2>Add Employee</h2>
        </div>
        <p class="message <?php echo ($message == "Account created successfully") ? 'success' : ''; ?>">
            <?php echo htmlspecialchars($message); ?>
        </p>

        <form method="post">
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" id="firstname" placeholder="First Name" required>

            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" id="lastname" placeholder="Last Name" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email@email.com" required>
            
            <label for="role">Role</label>
            <select name="role" id="role" required>
                <option value="">Select Role</option>
                <option value="Administrator">Administrator</option>
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

            <hr>
            <h3 style="text-align: left; color: #2e7d32;">Personal Information</h3>

            <label for="dob">Date of Birth</label>
            <input type="date" name="dob" id="dob" required>

            <label for="nationality">Nationality</label>
            <select name="nationality" id="nationality" required>
                <option value="">Select Nationality</option>
                <option value="Filipino">Filipino</option>
                <option value="American">American</option>
                <option value="Canadian">Canadian</option>
                <option value="Other">Other</option>
            </select>

            <label for="phone">Phone Number</label>
            <input type="text" name="phone" id="phone" required>

            <label for="marital">Marital Status</label>
            <select name="marital" id="marital" required>
                <option value="">Select Status</option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Divorced">Divorced</option>
                <option value="Widowed">Widowed</option>
            </select>

            <label for="national_id">National ID Number</label>
            <input type="text" name="national_id" id="national_id" required>

            <hr>
            <h3 style="text-align: left; color: #2e7d32;">Address</h3>

            <label for="address">Primary Address</label>
            <input type="text" name="address" id="address" required>

            <label for="city">City</label>
            <select name="city" id="city" required>
                <option value="">Select City</option>
                <option value="Manila">Manila</option>
                <option value="Quezon City">Quezon City</option>
                <option value="Las Pinas">Las Pinas</option>
                
            </select>

            <label for="country">Country</label>
            <select name="country" id="country" required>
                <option value="">Select Country</option>
                <option value="Philippines">Philippines</option>
                <option value="Other">Other</option>
            </select>

            <label for="postal">Postal Code</label>
            <input type="number" name="postal" id="postal" required>

            <label for="state">State/Province</label>
            <select name="state" id="state" required>
                <option value="">Select State/Province</option>
                <option value="Metro Manila">Metro Manila</option>
                <option value="Rizal"> Rizal </option>
            </select>

            <hr>
            <h3 style="text-align: left; color: #2e7d32;">Emergency Contact</h3>

            <label for="guardian">Guardian Name</label>
            <input type="text" name="guardian" id="guardian" required>

            <label for="emergency_phone">Emergency Number</label>
            <input type="text" name="emergency_phone" id="emergency_phone" required>

            <label for="relationship">Relationship</label>
            <input type="text" name="relationship" id="relationship" required>

            <button type="submit" name="submit">Add</button>
            <input type="reset" value="Reset">
        </form>
    </div>
</body>
</html>
