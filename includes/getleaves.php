<?php
include 'db_connect.php';
$count_query = "SELECT COUNT(*) FROM leaves";
$total_records = mysqli_fetch_row(mysqli_query($conn, $count_query));

// Grab da shit you need from leaves table
$sql = "SELECT itemid,authorid,leavestart,leaveend,reason,status FROM leaves";
$result = $conn->query($sql);

//prepare da query for the foreign key
$stmt = $conn->prepare("SELECT firstName,lastName,department FROM workers WHERE workerId = ?");
$stmt->bind_param("i", $workerid,);


echo "the number of rows in leaves is:",$total_records[0];
echo "<br>";
$total = $total_records[0];
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $workerid = $row["authorid"];
    $stmt->execute();
    $stmt->bind_result($firstname,$lastname,$department);
    $stmt->fetch();
    $fullname = $firstname." ".$lastname;
    echo "authorid: ".$workerid." firstname: ".$firstname." Last name: ".$lastname. " department: ".$department." leave start: " . $row["leavestart"]. " - leave end: " . $row["leaveend"]. " reason: " . $row["reason"]." status: ".$row["status"]."";
    if($row["status"] == "pending"){
        echo '<a href="changestate.php?id='.$row['itemid'].'&action=accept'.'"  "><button  type="button">accept</button></a>';
        echo '<a href="changestate.php?id='.$row['itemid'].'&action=reject'.'"  "><button  type="button">reject</button></a><br>';
    }
    else{
    echo '<br>';
    }
  }
} else {
  echo "0 results";
}
?>