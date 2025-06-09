<?php
include 'db_connect.php';
$count_query = "SELECT COUNT(*) FROM leaves";
$total_records = mysqli_fetch_row(mysqli_query($conn, $count_query));

$count_query_pending = "SELECT COUNT(*) FROM leaves WHERE status = 'pending'";
$total_records_pending = mysqli_fetch_row(mysqli_query($conn, $count_query_pending));

$count_query_accepted = "SELECT COUNT(*) FROM leaves WHERE status = 'Accepted'";
$total_records_accepted = mysqli_fetch_row(mysqli_query($conn, $count_query_accepted));

$count_query_rejected = "SELECT COUNT(*) FROM leaves WHERE status = 'Rejected'";
$total_records_rejected = mysqli_fetch_row(mysqli_query($conn, $count_query_rejected));

// Grab da shit you need from leaves table
$sql = "SELECT itemid,authorid,leavestart,leaveend,reason,status FROM leaves";
$result = $conn->query($sql);

//prepare da query for the foreign key
$stmt = $conn->prepare("SELECT firstName,lastName,department FROM workers WHERE workerId = ?");
$stmt->bind_param("i", $workerid,);


$total = $total_records[0];
$total_pending = $total_records_pending[0];
$total_accepted = $total_records_accepted[0];
$total_rejected = $total_records_rejected[0];
echo "Total Record of leaves:",$total;
echo "<br>";
echo "Total leaves rejected:",$total_rejected;
echo "<br>";
echo "Total leaves accepted:",$total_accepted;
echo "<br>";
echo "Total leaves pending:",$total_pending;
echo "<br>";
?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Leave Start</th>
                    <th>Leave End</th>
                    <th>Reason</th>
                    <th>Action Taken</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

<?php 
          if ($result = $conn->query($sql)) {
                    while ($row = $result->fetch_assoc()) {
                        $workerid = $row["authorid"];
                        $stmt->execute();
                        $stmt->bind_result($firstname,$lastname,$department);
                        $stmt->fetch();
                        $fullname = $firstname." ".$lastname;
                        echo '<tr> 
                                  <td>'.$workerid.'</td> 
                                  <td>'.$fullname.'</td> 
                                  <td>'.$department.'</td> 
                                  <td>'.$row['leavestart'].'</td>
                                  <td>'.$row['leaveend'].'</td>
                                  <td>'.$row['reason'].'</td>
                                  <td>'.$row['status'].'</td>';
                        if($row['status'] == 'pending'){
                            echo
                                  '<td> <a href="includes/changestate.php?id='.$row['itemid'].'&action=accept'.'"  "><button  type="button">accept</button></a>
                                    <a href="includes/changestate.php?id='.$row['itemid'].'&action=reject'.'"  "><button  type="button">reject</button></a>
                                  </td>
                              </tr>';
                        }
                        else{
                            echo    
                                    '<td> 
                                        Accomplished
                                    </td>
                                </tr>';
                        }
                    }
                    $result->free();
                }
                ?>
            </tbody>
        </table>