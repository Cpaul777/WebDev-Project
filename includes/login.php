
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="../styles/login.css">
</head>
<?php
include 'db_connect.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute
    $stmt = $conn->prepare("SELECT hashedpassword, salt,userid  FROM users WHERE email = ?");
    $stmt->bind_param("s", $email,);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($db_password, $salt , $emailid);
        $stmt->fetch();
        $passwordsalted = $password.$salt;
        if (password_verify($passwordsalted,$db_password)) {
            $message = "Login successful";
                $getrolestmt = $conn->prepare("SELECT role, department,workerID,firstName,lastName FROM Workers WHERE emailId = ?");
                $getrolestmt->bind_param("s", $emailid,);
                $getrolestmt->execute();
                $getrolestmt->store_result();
                $getrolestmt->bind_result($role,$department,$workerid,$firstname,$lastname);
                $getrolestmt->fetch();
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['workerid'] = $workerid;
            $_SESSION['department'] = $department;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['role'] = $role;
            $_SESSION['lastname'] = $lastname;
            header("Location: ../index.php");
            exit();
        } else {
            $message = "Incorrect password";
        }
    } else {
        $message = "Email not found";
    }
    $getrolestmt->close();
    $conn->close();
}
?>
<body>
  <div class="login-container">
  <div class="login-left">
    <img src="../img/background-cover.png" alt="Las Piñas City" class="bg-image">
  </div>

  <div class="login-right">
    <div class="login-form">
      <img src="../img/logo-laspinas.png" alt="City Logo" class="city-logo">

      <h2>Las Piñas <br>HR System Management</h2>

      <form action="login.php" method="POST">
        <div class="input-group">
          <label for="Username">Username</label>
          <input type="email" id="email" name="email" placeholder="Email" required>
        </div>

        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" name="submit" value="submit"">Sign in</button>
      </form>
    </div>
  </div>
</div>
</body>
</html>

