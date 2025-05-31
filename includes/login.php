<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="../styles/login.css">
</head>
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
          <input type="Username" id="Username" name="Username" placeholder="lpdelacruz" required>
        </div>

        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" name="submit" value="submit" onclick="document.location='../index.php'">Sign in</button>
      </form>
    </div>
  </div>
</div>
</body>
</html>

