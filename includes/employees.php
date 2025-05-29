<?php
include 'db_connect.php';
session_start();

// Check if the user is logged in, if
// not then redirect them to the login page

if (!isset( $_GET['offset']) || $_GET['offset'] < 0 ) {
    $offset = 0;
} else {
    $offset = ($_GET['offset']-1)*3;
}
$query = "SELECT * FROM Workers LIMIT 3 OFFSET $offset";
?>
<table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
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
                                  <td>'.$firstname.'</td> 
                                  <td>'.$lastname.'</td> 
                                  <td>'.$email.'</td> 
                                  <td>'.$role.'</td>
                                  <td>'.$gender.'</td>
                                  <td>'.$department.'</td>
                                  <td>'.$hiredate.'</td>
                                  <td> <form action="edit.php" method="post""><button name="id" type="submit" value="'.$id.'">Edit</button> </form>
                                       <a href="delete.php?id='.$id.'&offset='.$offset.'" onclick="return confirm(\'Are you sure?\') "><button type="button">delete</button></a>
                                  </td>
                              </tr>';
                    }
                    $result->free();
                }
                ?>
                
        <span>Page</span><input type="text" name="page" id="employee_offset" value="1"> <button id="employee_offset_go" onclick="employeeListDetect()"> go </button>
            </tbody>
 </table>
