<?php
session_start();
session_destroy();
echo 'You have been logged out. <a href="includes/login.php">log back in?</a>';
?>

