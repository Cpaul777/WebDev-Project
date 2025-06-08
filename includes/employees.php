<?php
include 'db_connect.php';
session_start();

// Check if the user is logged in, if
// not then redirect them to the login page
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$records_per_page = 5;

// For pagination
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if($current_page < 1) $current_page = 1;

$offset = ($current_page - 1) * $records_per_page;

// Base query, to add filters later
$query = "SELECT * FROM workers";
$count_query = "SELECT COUNT(*) FROM workers";

// Apply filters if set
$filters = [];
if (isset($_GET['department']) && $_GET['department'] !== '') {
    // Same logic to every other filter it like this: 
    // department = '(the filter e.g 'HR')'
    $filters[] = "department = '".mysqli_real_escape_string($conn, $_GET['department'])."'";
}
if (isset($_GET['status']) && $_GET['status'] !== '') {
    $filters[] = "status = '".mysqli_real_escape_string($conn, $_GET['status'])."'";
}
if (isset($_GET['role']) && $_GET['role'] !== '') {
    $filters[] = "role = '".mysqli_real_escape_string($conn, $_GET['role'])."'";
}
if (isset($_GET['search']) && $_GET['search'] !== '') {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $filters[] = "(firstName LIKE '%$search%' OR lastName LIKE '%$search%')";
}
// Checking if the filter array is not empty, and apply the filter
// Implode is to add a separateor for the $filter array
if (!empty($filters)) {
    $query .= " WHERE " . implode(' AND ', $filters);
    $count_query .= " WHERE " . implode(' AND ', $filters);
} 

// Pagination limit
$query .= " LIMIT $records_per_page OFFSET $offset";

$total_records = mysqli_fetch_row(mysqli_query($conn, $count_query));
$total_pages = ceil($total_records[0] / $records_per_page);

// For the department filter, putting the query to the departments[] array
$dept_query = "SELECT DISTINCT department FROM workers";
$dept_result = mysqli_query($conn, $dept_query);
$departments = [];
while ($row = mysqli_fetch_assoc($dept_result)) {
    $departments[] = $row['department'];
}

// For the role filter, puting the query to the roles[] array
$role_query = "SELECT DISTINCT role FROM workers";
$role_result = mysqli_query($conn, $role_query);
$roles = [];
while ($row = mysqli_fetch_assoc($role_result)) {
    $roles[] = $row['role'];
}


?>

<h3 id="employee-tab" onclick="employeeWord()">Employees Database</h3>
<div class="table-container">
    <div class="header">
        <div class="search-container">
                <i class="bi bi-search"></i>
                 <input type="text" name="searchBar" id="searchInput" placeholder="Search Employee">
        </div>
        <select class="filter-select" id="department-filter">
            <option value="">All Departments</option>
            <?php foreach($departments as $dept): ?>
                <!-- Looping through everydepartment with the value that is from the deptarments array  -->
            <option value="<?= $dept?>" <?= isset($_GET['department']) && $_GET['department'] === $dept ? 'selected' : '' ?> > <?= $dept ?> </option>
            <?php endforeach;?>
        </select>


        <!-- TO DO WHAT WILL BE THE ROLES WE WILL USE? -->
         <select class="filter-select" id="role-filter">
            <option value="">All Role</option>
            <?php foreach($roles as $role): ?>
            <option value="<?= $role?>" <?= isset($_GET['role']) && $_GET['role'] === $role ? 'selected' : '' ?> > <?= $role ?> </option>
            <?php endforeach;?>
        </select>
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
                                    <td>
                                        <div class="action-buttons">
                                        <form action="editEmployee.php" method="post">
                                        <button class="btn btn-edit" name="id" type="submit" value="'.$id.'">Edit</button>
                                        </form>
                                        <a href="includes/delete.php?id='.$id.'&offset='.$offset.'" onclick="return confirm(\'Are you sure?\') "><button class="btn btn-delete" type="button">delete</button></a>
                                        </div>
                                    </td>
                                </tr>';
                        }
                            $result->free();

                        }
                        if($total_pages == 0){
                        echo '<tr><td>No Employees Found</td></tr>';
                    }
                    
                    ?>
                </tbody>
    </table>

    <div class="pagination">
        <div class="pagination-controls">
           <!-- Pagination -->
            <?php if ($current_page > 1): ?>
                <button class="pagination-btn" id="prevBtn" onclick="employeeListDetect(<?= $current_page - 1?>)" value="<? echo $current_page?>">
                    <i class="bi bi-arrow-left-circle"></i>
                </button>
            <?php else: ?>
                <button class="pagination-btn" id="prevBtn" disabled>
                    <i class="bi bi-arrow-left-circle"></i>
                </button>
            <?php endif;?>
            <span class="page-indicator">Page</span>
            <span class="page-indicator" id="currentPage"><?php echo ($total_pages == 0 ? 0: $current_page); ?></span>
            <span class="page-indicator">of</span>
            <span class="page-indicator" id="totalPages"><?php echo $total_pages; ?></span>
            
            <?php if ($current_page < $total_pages): ?>
                <button class="pagination-btn" id="nextBtn" onclick="employeeListDetect(<?= $current_page + 1?>)" value="1">
                    <i class="bi bi-arrow-right-circle"></i>
                </button>
            <?php else: ?>
                 <button class="pagination-btn" id="nextBtn" disabled>
                    <i class="bi bi-arrow-right-circle"></i>
                </button>
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

        <!-- <input type="text" name="page" " value="<?php //echo $current_page?>">  -->


<!-- <?php 
            // if ($current_page > 1) echo "<a href='?page=" . ($current_page - 1) . "'><i class='bi bi-arrow-left-circle'></i></a> ";

            // if ($current_page < $total_pages) echo "<a href='?page=" . ($current_page + 1) . "'>Next &raquo;</a>";
            // echo "</div>";
        ?> -->


