<?php
include 'db_connect.php';
session_start();

// Check if the user is logged in, if
// not then redirect them to the login page

$records_per_page = 5;

// For pagination
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if($current_page < 1) $current_page = 1;


$offset = ($current_page - 1) * $records_per_page;

// if (!isset( $_GET['offset']) || $_GET['offset'] < 0 ) {
//     $offset = 0;
// } else {
//     $offset = ($_GET['']-1)* $records_per_page;
// }

$query = "SELECT * FROM Workers LIMIT $records_per_page OFFSET $offset";

$total_records = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM workers"));
$total_pages = ceil($total_records[0] / $records_per_page);
?>


<div class="table-container">
    <div class="header">
        
    </div>

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
                                    <td> <form action="editEmployee.php" method="post""><div class="action-buttons"><button class="btn btn-edit" name="id" type="submit" value="'.$id.'">Edit</button> </form>
                                        <a href="delete.php?id='.$id.'&offset='.$offset.'" onclick="return confirm(\'Are you sure?\') "><button class="btn btn-delete" type="button">delete</button></a></div>
                                    </td>
                                </tr>';
                        }
                        $result->free();
                    }
                    ?>
                    
                </tbody>
    </table>


    <div class="pagination">
        <div class="pagination-controls">
            <?php if ($current_page > 1): ?>
                <a href="#" onclick="employeeListDetect(<?php echo ($current_page - 1) ?>)">
                    <i class="bi bi-arrow-left-circle"></i>
                </a>
            <?php else: ?>
                <span class="disabled-arrow">
                    <i class="bi bi-arrow-left-circle"></i>
                </span>
            <?php endif; ?>
            
            <span class="page-indicator">Page <?php echo $current_page; ?> of <?php echo $total_pages; ?></span>
            
            <?php if ($current_page < $total_pages): ?>
                <a href="#" onclick="employeeListDetect(<?php echo ($current_page + 1); ?>)">
                    <i class="bi bi-arrow-right-circle"></i>
                </a>
            <?php else: ?>
                <span class="disabled-arrow">
                    <i class="bi bi-arrow-right-circle"></i>
                </span>
            <?php endif; ?>
        </div>
    </div>
            
</div>




<!--  -->
<?php
            // echo $current_page;
            // if ($current_page > 1) { 
                // echo "It entered here";

                // echo '<a href="#" id="employee_pageNum" data-php-variable="'.$current_page.'" onclick="employeeListDetect()"><i class="bi bi-arrow-left-circle"></i></a>';

                // echo '<button id="employee_offset_back" data-php-variable="'.($current_page--).'" onclick="employeeListDetect()"> <i class="bi bi-arrow-left-circle"></i>sfsd </button>';
            // }
            //     echo '<span class="page-indicator">Page '. $current_page . ' of ' .$total_pages . '</span>';
            // if ($current_page < $total_pages) {

            //     echo '<a href="#" id="employee_pageNum" data-php-variable="'.$current_page.'" onclick="employeeListDetect()"><i class="bi bi-arrow-right-circle"></i></a>';
                
            //     // echo '<button id="employee_offset_back" data-php-variable="'. ($current_page) . '"onclick="employeeListDetect()"> <i class="bi bi-arrow-right-circle"></i> </button>';
            // }

            ?> 
            <!-- <button id="employee_offset_go" onclick="employeeListDetect()"> Next &raquo; </button> -->
        </div>

        <!-- <input type="text" name="page" " value="<?php echo $current_page?>">  -->


<!-- <?php 
            // if ($current_page > 1) echo "<a href='?page=" . ($current_page - 1) . "'><i class='bi bi-arrow-left-circle'></i></a> ";

            // if ($current_page < $total_pages) echo "<a href='?page=" . ($current_page + 1) . "'>Next &raquo;</a>";
            // echo "</div>";
        ?> -->