<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
} 

if (!($_SESSION['role'] == 'administrator') && !($_SESSION['role'] == 'Administrator')) {
    echo 'it entered here?';
    header("Location: employeePage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Job Posting</title>
    <link rel="stylesheet" href="../styles/employeepage.css">
    <style>
        body {
            background: #f8f8f8;
            font-family: 'Poppins', sans-serif;
        }
        .job-form-container {
            background: #fff;
            max-width: 480px;
            margin: 48px auto 0 auto;
            border-radius: 16px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.07);
            padding: 36px 32px 28px 32px;
        }
        .job-form-container h2 {
            color: #008F05;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 24px;
            text-align: center;
        }
        .job-form label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: #222;
        }
        .job-form input[type="text"],
        .job-form input[type="date"],
        .job-form textarea {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            margin-bottom: 18px;
            font-size: 1rem;
            font-family: inherit;
            background: #f8f8f8;
            transition: border 0.2s;
        }
        .job-form textarea {
            min-height: 70px;
            resize: vertical;
        }
        .job-form input[type="file"] {
            margin-bottom: 18px;
        }
        .job-form input[type="submit"] {
            width: 100%;
            background: #008F05;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 12px 0;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .job-form input[type="submit"]:hover {
            background: #00c81b;
        }
        .back-btn-jobform {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            margin-bottom: 18px;
            font-size: 1rem;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            color: #008F05;
            background-color: #e5f5e5;
            border: 1.5px solid #008F05;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.2s, border 0.2s;
        }
        .back-btn-jobform:hover {
            background-color: #008F05;
            color: #fff;
            border-color: #008F05;
        }
    </style>
</head>
<body>

    <div class="job-form-container">
         <a href="../index.php?tab=includes/jobs.php" class="back-btn-jobform">
        <svg viewBox="0 0 24 24" width="20" height="20" style="vertical-align:middle;margin-right:6px;">
            <path d="M15 18l-6-6 6-6" stroke="#008F05" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
            Back
        </a>
        <h2>Create Job Posting</h2>
        <form class="job-form" method="post" enctype="multipart/form-data" action="makejob.php" onsubmit="return validateJobForm();">
            
        <label for="title">Job Title</label>
            <input type="text" name="title" id="title" required pattern="[A-Za-z0-9 .,'-]{2,50}" title="Letters, numbers, and basic punctuation only (2-50 chars)">

            <label for="department">Department</label>
            <input type="text" name="department" id="department" required pattern="[A-Za-z .'-]{2,50}" title="Letters and spaces only (2-50 chars)">

            <label for="location">Location</label>
            <input type="text" name="location" id="location" required pattern="[A-Za-z0-9 .,'-]{2,50}" title="Letters, numbers, and basic punctuation only (2-50 chars)">

            <label for="category">Category</label>
            <input type="text" name="category" id="category" required pattern="[A-Za-z .'-]{2,30}" title="Letters and spaces only (2-30 chars)">

            <label for="closedate">Closing Date</label>
            <input type="date" name="closedate" id="closedate" required min="<?php echo date('Y-m-d'); ?>">

            <label for="requirements">Requirements</label>
            <textarea name="requirements" id="requirements" required minlength="5" maxlength="500" placeholder="Separate bullets by semi-colon ';'"></textarea>

            <label for="description">Description</label>
            <textarea name="description" id="description" required minlength="5" maxlength="1000"></textarea>

            <label for="fileToUpload">Upload Image/Document</label>
            <input type="file" name="fileToUpload" id="fileToUpload" required>
            <input type="submit" value="Submit">
        </form>
    </div>
    <script>
    function validateJobForm() {
        // Only allow future dates for closing date
        const closeDate = document.getElementById('closedate').value;
        if (closeDate && new Date(closeDate) < new Date().setHours(0,0,0,0)) {
            alert('Closing date must be today or in the future.');
            return false;
        }   
        return true;
    } 
    
</script>
</body>
</html>
