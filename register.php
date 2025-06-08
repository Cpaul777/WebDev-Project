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
    <style>
       body {
    font-family:'Poppins' sans-serif;
    background-color: #e8f5e9; /* Soft green background */
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background-color: #ffffff; /* White background for the form */
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    padding: 30px;
    width: 320px; /* Smaller width for a compact look */
    text-align: center;
}

.container h2 {
    color: #2e7d32; /* Dark green heading */
    margin-bottom: 20px;
    font-size: 24px;
}

.container input[type="text"],
.container input[type="password"],
.container input[type="email"] {
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

.container input[type="submit"]:hover,
.container input[type="reset"]:hover {
    background-color: #1b5e20; /* Darker green on hover */
}

.container a {
    display: block;
    margin-top: 15px;
    color: #2e7d32; /* Green links */
    text-decoration: none;
    font-size: 14px;
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
        <p class="message <?php echo ($message == "Account created successfully") ? 'success' : ''; ?>">
            <?php echo htmlspecialchars($message); ?>
        </p>
        <form method="post">
            <input type="text" name="firstname" placeholder="First Name" required><br>
            <input type="text" name="lastname" placeholder="Last Name" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <select name="gender" id="gender">
                <option value="MALE">MALE</option>
                <option value="FEMALE">FEMALE</option>
                <option value="OTHER">OTHERS</option>
             </select>
            <input type="submit" value="Sign Up">
            <input type="reset" value="Reset">
        </form>
        <a href="login.php">Log In</a>
    </div>
</body>
</html>







