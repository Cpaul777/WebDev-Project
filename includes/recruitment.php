<?php
var_dump($_POST);
include '../includes/db_connect.php';
session_start();

// Check if the user is logged in, if
// not then redirect them to the login page
if (!isset($_SESSION['email'])) {
    header("Location: ..//login.php");
    exit();
}
$target_dir = "../externalsites/applications/";

$target_pds = $target_dir . basename($_FILES["pds"]["name"]);
$target_resume = $target_dir . basename($_FILES["resume"]["name"]);
$target_tor = $target_dir . basename($_FILES["tor"]["name"]);

$uploadOk = 1;
$pdsfiletype = strtolower(pathinfo($target_pds,PATHINFO_EXTENSION));
$resumefiletype = strtolower(pathinfo($target_resume,PATHINFO_EXTENSION));
$torfiletype = strtolower(pathinfo($target_tor,PATHINFO_EXTENSION));


// Check if file already exists
if (file_exists($target_pds)) {
  $state = "Sorry, pds already exists.";
  $uploadOk = 0;
}
if (file_exists($target_resume)) {
  $state = "Sorry, resume already exists.";
  $uploadOk = 0;
}
if (file_exists($target_tor)) {
  $state = "Sorry, tor already exists.";
  $uploadOk = 0;
}


// Check file size
if ($_FILES["pds"]["size"] > 10000000) {
  $state = "Sorry, your personal data sheet is too large.";
  $uploadOk = 0;
}
if ($_FILES["resume"]["size"] > 10000000) {
  $state = "Sorry, your file is too large.";
  $uploadOk = 0;
}
if ($_FILES["tor"]["size"] > 10000000) {
  $state = "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($pdsfiletype != "pdf" && $torfiletype != "pdf" && $resumefiletype != "pdf" ) {
  $state = "Sorry, only pdf files are allowed.";
  $uploadOk = 0;
}
$renamedpds =  $target_dir .'pds'.$_POST['fn']. $_POST['ln'].$_POST['timestamp'].'.'.$pdsfiletype;

$renamedresume =  $target_dir .'resume'.$_POST['fn']. $_POST['ln'].$_POST['timestamp'].'.'.$resumefiletype;

$renamedtor =  $target_dir.'tor' .$_POST['fn']. $_POST['ln'].$_POST['timestamp'].'.'.$torfiletype;
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {;
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["pds"]["tmp_name"], $renamedpds)
    && move_uploaded_file($_FILES["tor"]["tmp_name"], $renamedtor) 
    && move_uploaded_file($_FILES["resume"]["tmp_name"], $renamedresume)) {
        $state = "The files has been uploaded.";
        $stmt = $conn->prepare("INSERT INTO applications (firstname, lastname,email,pds, resume,tor,jobid) VALUES (?, ?,? , ?, ?, ?,?)");
        $stmt->bind_param("sssssss", $_POST['fn'],$_POST['ln'],$_POST['email'], $renamedpds,$renamedresume,$renamedtor,$_POST['jobid']);
        if($stmt->execute()){
            $state = "application successfully generated";
        }
        else{
            $state = "application failed to generate, report this to admin immediately";
        }
    $stmt->close();
    }
    else {
    $state = "Sorry, there was an error uploading your file.";
    }
}

   

    echo '<script>
    alert("'.$state.' ");
    window.location.href = "../externalsites/jobs.php";
    </script>';
    exit;

    

 

?>