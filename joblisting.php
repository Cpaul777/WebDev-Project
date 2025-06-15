<?php
include 'includes/db_connect.php';
session_start();

// Check if the user is logged in, if
// not then redirect them to the login page


// Grab da shit you need from jobs table
$sql = "SELECT jobid,role,department,closingdate,requirements,description,img FROM jobs";
?>

<div class="top-bar">
    <h3 class="section-title" id="job-tab">available jobs</h3>
</div>
   
<div class="table-container">
    
    <table class="job-table">
            <thead>
                <tr>
                    <th>closing date</th>
                    <th>department</th>
                    <th>role</th>
                    <th>requirements</th>
                    <th>description</th>
                    <th>picture</th>

                </tr>
            </thead>
            <tbody>
            <?php 
                    if ($result = $conn->query($sql)) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr> 
                                            <td>'.$row['closingdate'].'</td> 
                                            <td>'.$row['department'].'</td> 
                                            <td>'.$row['role'].'</td>
                                            <td>'.$row['requirements'].'</td>
                                            <td>'.$row['description'].'</td> 
                                            <td> <img src="includes/'.$row['img'].'" alt=""></td> 
                                        </tr>';
                                }

                    }
                    $result->close();
                    echo `whoami`;
            ?>
<img src="" alt="">
        </tbody>
    </table>
</div>
