<?php
include 'includes/db_connect.php';

$message = "";

if (!isset($_POST['id'])){
    header("Location: no_id.php");
  exit();
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
      } else {
          $message = "Error: " . $stmt->error;
      }
    }

    $stmt = $conn->prepare("SELECT firstName, lastName, emailId, role, gender, department FROM workers WHERE workerId = ?");
    $stmt->bind_param("i", $id,);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($firstname, $lastname, $emailid,$role, $gender, $department);
    $stmt->fetch();

    $stmt = $conn->prepare("SELECT email FROM users WHERE userid = ?");
    $stmt->bind_param("i", $emailid,);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($email);
    $stmt->fetch();
?>
welcome admin
<?php if ($conn) {
  echo 'connected', "<br>\n";
} else {
  echo 'not connected';
}
?>
selected First Name is <?php echo $firstname;?> <br>
selected Last Name is <?php echo $lastname;?> <br>
selected Email is <?php echo $email;?> <br>
selected role is <?php echo $role;?> <br>
selected gender is <?php echo $gender;?> <br>
selected department is <?php echo $department;?> <br>

<?php echo $message;?> <br>

<form method="post">
<h2>Edit</h2>
    First Name: <input type="text" name="newfirstname"><br>
    Last Name: <input type="text" name="newlastname"><br>
    Email: <input type="text" name="newemail"><br>
    Role: <input type="text" name="newrole"><br>
    Gender: <input type="text" name="newgender"><br>
    Department: <input type="text" name="newdepartment"><br>
    <br>
    <input type="hidden" name="id" value="<?php echo $id;?>" />
    <input type="hidden" name="emailid" value="<?php echo $emailid;?>" />
    <input type="submit">
    <ibr="reset">
    </form>
</body>
