<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="jobs.css">
</head>
<body>
    <div class="top-menu">
         <div class="las-pinas">
            <i class="bi bi-bank2"></i>
            <h2> Las Piñas Job Portal</h2>
         </div>
         <div class="tabs">
            <ul>
                <li><a href="jportal.php">Home</a></li>
                <li><a href="jobs.php" class="active">Jobs</a></li>
                <li><a href="about.php" >About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
         </div>
        
         <div class="right-side">
            <button class="sign-btn" id="sign-up">Sign Up</button>
            <button class="login-btn" id="login-btn">Login</button>
         </div>

    </div>

    <div class="main-section">
        <h1>Job Openings</h1>
        <p>Explore current job opportunities within the local government.</p>
        <div class="job-filters">
            <button type="button">Department <i class="bi bi-chevron-down"></i></button>
            <button type="button">Location <i class="bi bi-chevron-down"></i></button>
            <button type="button">Category <i class="bi bi-chevron-down"></i></button>
        </div>
        <div class="job-table-container">
        <table class="job-table">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Department</th>
                    <th>Location</th>
                    <th>Category</th>
                    <th>Posted Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Administrative Assistant</td>
                    <td class="department">Human Resources</td>
                    <td>City Hall</td>
                    <td><span>Administrative</span></td>
                    <td>2023-08-15</td>
                    <td><span class="status-open">Open</span></td>
                </tr>
                <tr>
                    <td>Civil Engineer</td>
                    <td class="department">Public Works</td>
                    <td>Engineering Department</td>
                    <td><span>Engineering</span></td>
                    <td>2023-08-10</td>
                    <td><span class="status-open">Open</span></td>
                </tr>
                <tr>
                    <td>Social Worker</td>
                    <td class="department">Social Services</td>
                    <td>Community Center</td>
                    <td><span>Social Services</span></td>
                    <td>2024-11-30</td>
                    <td><span class="status-open">Open</span></td>
                </tr>
                <tr>
                    <td>IT Specialist</td>
                    <td class="department">Information Technology</td>
                    <td>City Hall</td>
                    <td><span>IT</span></td>
                    <td>2023-07-30</td>
                    <td><span class="status-open">Open</span></td>
                </tr>
                <tr>
                    <td>Accountant</td>
                    <td class="department">Finance</td>
                    <td>City Hall</td>
                    <td><span>Finance</span></td>
                    <td>2023-07-25</td>
                    <td><span class="status-open">Open</span></td>
                </tr>
                <tr>
                    <td>Librarian</td>
                    <td class="department">Library</td>
                    <td>Main Library</td>
                    <td><span>Library</span></td>
                    <td>2023-07-20</td>
                    <td><span class="status-open">Open</span></td>
                </tr>
                <tr>
                    <td>Police Officer</td>
                    <td class="department">Police Department</td>
                    <td>Police Station</td>
                    <td><span>Law Enforcement</span></td>
                    <td>2023-07-15</td>
                    <td><span class="status-open">Open</span></td>
                </tr>
                <tr>
                    <td>Firefighter</td>
                    <td class="department">Fire Department</td>
                    <td>Fire Station</td>
                    <td><span>Emergency Services</span></td>
                    <td>2023-07-10</td>
                    <td><span class="status-open">Open</span></td>
                </tr>
                <tr>
                    <td>Teacher</td>
                    <td class="department">Education</td>
                    <td>Public Schools</td>
                    <td><span>Education</span></td>
                    <td>2023-07-05</td>
                    <td><span class="status-open">Open</span></td>
                </tr>
                <tr>
                    <td>Park Ranger</td>
                    <td class="department">Parks and Recreation</td>
                    <td>City Parks</td>
                    <td><span>Recreation</span></td>
                    <td>2023-07-01</td>
                    <td><span class="status-open">Open</span></td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>

    <!-- <form method="post" enctype="multipart/form-data" action="includes/makejob.php">
            <input type="text" name="title" id="title">
            <label for="title">Job Title</label>
            <br>
            <input type="text" name="department" id="department">
            <label for="department">Department</label>
            <br>
            <input type="date" name="closedate" id="closedate">
            <label for="closedate">closes at</label>
            <br>
            <input type="textarea" name="requirements" id="requirements">
            <label for="requirements">requirements</label>
            <br>
            <input type="textarea" name="description" id="description">
            <label for="description">description</label>
            <br>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <br>
            <input type="submit" value="Submit">
        </form> -->

    <footer>
        <div class="footer-links">
            <ul>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="privacy.php">Privacy Policy</a></li>
                <li><a href="terms.php">Terms of Service</a></li>

            </ul>
        </div>
        <p>&copy;2024 Las Pinas Job Portal. All rights reserved.</p>
    </footer>
</body>
</html>






<!--  -->

