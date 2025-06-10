<?php
include 'includes/db_connect.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $unset = "unset";
    $gender = $_POST['gender'];
    $password = $_POST['password'];
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
        $createworkerstmt->bind_param( "ssissss", $firstname, $lastname, $emailid['userid'],$unset,$unset,$gender,$date);
        if ($createworkerstmt->execute()) {
            $message = "Account created successfully";
            echo '<script> alert("'.$message.'") ;
                    window.location.href = "login.php";
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
<html>
<head>
    <meta charset="UTF-8" />
    <title>Sign Up</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600;800&display=swap" rel="stylesheet">
    <style>
       body {
            overflow: hidden;
            font-family:'Poppins', sans-serif;
            background-color: #e8f5e9; /* Soft green background */
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            height: 100vh;
        }

        .container {
            margin:auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            padding: 35px 30px;
            width: 60%;
            max-height: 90vh;
            overflow-y: auto;
            text-align: center;
            padding-top: 5px;
        }

        .container h2 {
            color: #2e7d32;
            margin-bottom: 25px;
            font-size: 26px;
        }

        .container label {
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
            margin-bottom: 25px;
        }

        .header-row h2 {
            margin: auto;
        }

        .container input[type="text"],
        .container input[type="password"],
        .container input[type="email"],
        .container input[type="date"],
        .container input[type="number"],
        .container select
         {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc; /* Light border */
            border-radius: 5px;
            box-sizing: border-box;
        }

        .container input[type="submit"],
        .container input[type="reset"] {
            background-color: #2e7d32; /* Green button */
            color: #ffffff; /* White text */
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            width: 100%;
            font-size: 16px;
        }

        .container input[type="submit"]:hover
         {
            background-color: #1b5e20; /* Darker green on hover */
        }

        .container input[type="reset"]{
            background-color:gray;
        }
        
        .container input[type="reset"]:hover{
            background-color:#333;
        }

        .container a {
            display: block;
            margin-top: 15px;
            color: #2e7d32; /* Green links */
            text-decoration: none;
            font-size: 16px;
        }

        .container a:hover {
            text-decoration: underline;
        }

        .message {
            margin-bottom: 15px;
            font-size: 14px;
            color: #e53935; /* Error red */
        }

        .success {
            color: #2e7d32; /* Success green */
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
        form input[type="submit"],
        form input[type="reset"],
        form .message {
            grid-column: 1 / -1;
        }

        .login{
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            font-size: 20px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-row">
            <h2>Sign Up</h2>
        </div>    
    
        <p class="message <?php echo ($message == "Account created successfully") ? 'success' : ''; ?>">
            <?php echo htmlspecialchars($message); ?>
        </p>
        <form method="post">
            <hr>

            <h3 style="text-align: left; color: #2e7d32;">Personal Information</h3>
            
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" id="firstname" placeholder="First Name" required>

            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" id="lastname" placeholder="Last Name" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="juan@gmail.com" required>

            <label for="passowrd">Password</label>
            <input type="password" name="password" placeholder="Password" required><br>
            <select name="gender" id="gender">
                <option value="MALE">MALE</option>
                <option value="FEMALE">FEMALE</option>
                <option value="OTHER">OTHERS</option>
             </select>

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
                <option value="Rizal">Rizal</option>
            </select>

            <hr>
            <h3 style="text-align: left; color: #2e7d32;">Emergency Contact</h3>

            <label for="guardian">Guardian Name</label>
            <input type="text" name="guardian" id="guardian" required>

            <label for="emergency_phone">Emergency Number</label>
            <input type="text" name="emergency_phone" id="emergency_phone" required>

            <label for="relationship">Relationship</label>
            <input type="text" name="relationship" id="relationship" required>

            <input type="reset" value="Reset">
            <input class="sign-up" type="submit" value="Sign Up">
        </form>
        <a href="login.php" class="login">Log In</a>
    </div>
</body>
</html>







