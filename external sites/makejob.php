<?php
var_dump($_POST);
include 'db_connect.php';
session_start();

// Check if the user is logged in, if
// not then redirect them to the login page
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
$target_dir = "jobimg/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $state = "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    $state = "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  $state = "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  $state = "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $state = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}
$renamedfile =  $target_dir .$_POST['title']. $_POST['closedate'].'.'.$imageFileType;
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {;
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $renamedfile)) {
        $state = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    
        $stmt = $conn->prepare("INSERT INTO jobs (role, department,closingdate, requirements,description,img) VALUES (?, ?, ?, ?, ?,?)");
        $stmt->bind_param("ssssss", $_POST['title'],$_POST['department'], $_POST['closedate'],$_POST['requirements'],$_POST['description'],$renamedfile);
        if($stmt->execute()){
            $state = "Job successfully generated";
        }
        else{
            $state = "Job failed to generate, report this to admin immediately";
        }
    $stmt->close();
    }
    else {
    $state = "Sorry, there was an error uploading your file.";
    }
}

   

    echo '<script>
    alert("'.$state.' ");
    window.location.href = "../index.php?tab=includes/jobs.php";
    </script>';
    exit;

    

 

?>