<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php session_start();
include 'includes/db_connect.php';

if (!isset($_GET['id'])){
    echo '<script>
    alert("User Does Not Exist");
    window.location.href = "../index.php?tab=includes/employees.php&page=1";
    </script>';
    exit;
}



$message = " ";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $currentdate = new DateTime(date('Y-m-d'));
    $startdatestamp = new DateTime($_POST['startdate']);
    $enddatestamp = new DateTime($_POST['enddate']);
    $timediff = $startdatestamp->diff($enddatestamp);
    $timediffdays = $timediff->days;
    $currenttimediff = $currentdate->diff($startdatestamp);
    $timediffnega = $timediff->invert;
    $currenttimediffnega = $currenttimediff->invert;
    echo 'number of days of leave selected: '.$timediff->days. 'days';
    if(($timediffnega == 1)||($timediff->days == 0)){
        $message = "NO TIME TRAVEL ALLOWED! (start date is equal to or greater than leave date)";
    }
    else{
        if(($currenttimediffnega == 1)||($currenttimediff->days == 0)){
            $message = "NO TIME TRAVEL ALLOWED!!! (start date is on or behind current date)";
        }
        else{
            $authorid = (int)$_SESSION['workerid'];
            $leavestart = $_POST['startdate'];
            $leaveend = $_POST['enddate'];
            $reason = $_POST['reason'];
            $status = $_POST['status'];
            $createleavestmt = $conn->prepare("INSERT INTO leaves (authorid,leavestart,leaveend,reason,status) VALUES (?, ?, ?, ?, ?)");
            $createleavestmt->bind_param("issss", $authorid,$leavestart, $leaveend,$reason,$status);
            if ($createleavestmt->execute()) {
                $message = "Leave Request created successfully";
            } else {
                $message = "Error: " . $stmt->error;
            }
            $createleavestmt->close();
        }
     }
    $conn->close();
}
?>

<body>
    <p>welcome <?php echo $_SESSION['firstname']," ",$_SESSION['lastname'] ;?></p>
    <p>your email is <?php echo $_SESSION['email'] ?></p>
    <hr>
    <p>submit leave request</p>
    <p>  <?php echo htmlspecialchars($message); ?> </p>
    <form method="POST">
            <label for="reason">Leave Reason</label>
            <select name="reason" id="reason">
                <option value="medical">Medical</option>
                <option value="pto">PTO</option>
                <option value="parental">Parental</option>
                <option value="bereavement">Bereavement</option>
                <option value="other">Other</option>
             </select>
            <br>
            <label for="startdate">Start Date</label>
            <input type="date" name="startdate" required><br>
            <label for="enddate">End Date</label>
            <input type="date" name="enddate" required><br>
            <input type="hidden" name="workerid" value="<?php echo $_SESSION['workerid']; ?>">
            <input type="hidden" name="status" value="pending">
            <input type="submit" value="Submit Leave">
    </form>
</body>
</html>