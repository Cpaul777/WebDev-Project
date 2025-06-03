<?php
include 'db_connect.php';
session_start();

// Check if the user is logged in, if
// not then redirect them to the login page

$records_per_page = 5;

if (!isset( $_GET['offset']) || $_GET['offset'] < 0 ) {
    $offset = 0;
} else {
    $offset = ($_GET['offset']-1)* $records_per_page;
}
$query = "SELECT * FROM Workers LIMIT 7 OFFSET $offset";

$total_records = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM workers"));
$total_pages = ceil($total_records[0] / $records_per_page);

?>


<div class="table-container">
    <table class="employee-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Gender</th>
                        <th>Department</th>
                        <th>hiredate</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result = $conn->query($query)) {
                        while ($row = $result->fetch_assoc()) {
                            $id = $row["workerId"];
                            $firstname = $row["firstName"];
                            $lastname = $row["lastName"];
                            $emailid = $row["emailId"];
                            $stmt = $conn->prepare("SELECT email FROM users WHERE userid = ?");
                            $stmt->bind_param("i", $emailid,);
                            $stmt->execute();
                            $stmt->store_result();
                            $stmt->bind_result($email);
                            $stmt->fetch();
                            $role = $row["role"];
                            $gender = $row["gender"];
                            $department = $row["department"];
                            $hiredate = $row["hireDate"];
                            echo '<tr> 
                                    <td>'.$firstname. ' '.$lastname.' </td> 
                                    <td>'.$email.'</td> 
                                    <td>'.$role.'</td>
                                    <td>'.$gender.'</td>
                                    <td>'.$department.'</td>
                                    <td>'.$hiredate.'</td>
                                    <td> <form action="editEmployee.php" method="post""><button name="id" type="submit" value="'.$id.'">Edit</button> </form>
                                        <a href="delete.php?id='.$id.'&offset='.$offset.'" onclick="return confirm(\'Are you sure?\') "><button type="button">delete</button></a>
                                    </td>
                                </tr>';
                        }
                        $result->free();
                    }
                    ?>
                    
                </tbody>
    </table>
    <div class="page">
        <span >Page</span><input type="text" name="page" id="employee_offset" value="1"> <button id="employee_offset_go" onclick="employeeListDetect()"> go </button>
    </div>
            
</div>