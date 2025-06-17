<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600;800&display=swap" rel="stylesheet">
    <style>
            * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        }

        :root {
            --top-bar-height: 68px;
            --dark-green:#008F05;
            --light-green:#00c81b;
            --very-light-green:#0af312;
            --bg-color:#F8F8F8;
            --dark-color:#333;
            --white-color:white;
            --other-white: #E5F5E5;
        }

        body{
            background-color: #F8F8F8;
            font-family: "Poppins", sans-serif;
            display: flex;
            flex-direction: column;
        }

        .top-menu {
            overflow: hidden;
            height: var(--top-bar-height);
            color: black;
            background-color:var(--white-color);
            display: flex;
            align-items: center;
            padding: 0 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            z-index: 100;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .top-menu .las-pinas{
            display: flex;
            align-items: center;
            gap: 15px;
            margin-right: 27px;
        }

        .top-menu .las-pinas i {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dark-color);
            vertical-align: middle;
        }

        .top-menu .las-pinas h2{
            font-size: 1.5rem;
            font-weight: 650;
            color: var(--dark-color);
            margin-left: 10px;
        }

        .top-menu ul{
            list-style: none;
            display: flex;
            height: 50px;
            align-items: center;
            margin: 0;
        }

        .top-menu ul li {
            width: 100%;
            height: auto;
            text-align: center;
            display: inline-block;
            position: relative;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }

        .top-menu ul li:hover{
            color: var(--dark-green);
            background-color: var(--bg-color);
            border-radius: 5px;
        }

        .top-menu ul li .active {
            color: var(--dark-green);
            background-color: var(--bg-color);
            border-radius: 5px;
        }

        .top-menu ul a:hover {
            color: var(--dark-green);
            background-color: var(--bg-color);
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .top-menu ul li a {
            color: black;
            text-decoration: none;
            font-size: large;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .top-menu .right-side {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-right: 12px;
        }

        /* Right side buttons */
        .top-menu .right-side button {
            background-color: var(--dark-green);
            color: var(--white-color);
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 700;
            transition: background-color 0.3s ease;
        }

        .top-menu .right-side .sign-btn:hover {
            background-color: var(--light-green);
        }
        .top-menu .right-side .login-btn:hover {
            background-color: #c4d2c4;
            color: var(--dark-color);
        }

        .top-menu .right-side .login-btn {
            background-color: var(--other-white);
            color: var(--dark-color);
            border: 1px solid var(--other-white);
            padding: 10px 20px;
        }

        .main-section {
            max-width: 1200px;
            margin: 32px auto 0 auto;
            padding: 32px 20px 20px 20px;
            background: var(--bg-color);
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
        }

        .main-section img {
            width: 100%;
            height: auto;
            border-radius: 16px;
            margin-bottom: 20px;
        }

        .main-section h1, .main-section h2 {
            color: #111;
        }
        .main-section h1 {
            font-size: 2rem;
            font-weight: 650;
            margin-bottom: 1.2rem;
        }
        .main-section h2 {
            font-size: 1.15rem;
            font-weight: 600;
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
        }
        .main-section p {
            font-size: 1.05rem;
            color: var(--dark-color);
            line-height: 1.6;
            margin-bottom: 18px;
        }
        
        footer{
            color: var(--light-green);
            text-align: center;
            justify-content: center;
        }

        footer p {
            font-size: 1rem;
            margin: 10px 0;
            font-weight: 600;
        }

        footer .footer-links {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap: 20px;
            padding: 20px;
            margin-bottom: 50px;
        }

        footer .footer-links ul{
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: row;
            gap: 150px;
        }

        footer .footer-links ul li{
            margin: 0 10px;
            display: inline-block;
            font-size: 1rem;
            margin: 0 10px;
        }

        footer .footer-links a{
            text-decoration: none;
            color: var(--light-green);
            font-weight: 500;
            transition: color 0.3s ease;
        }

        footer .footer-links a:hover {
            color: var(--dark-green);
            text-decoration: underline;
            text-shadow: 0 0 12px rgba(10, 243, 18, 0.28), 0 0 24px rgba(10, 243, 18, 0.18);
        }
    </style>
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
                <li><a href="jobs.php">Jobs</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
         </div>
        
         <div class="right-side">
            <button class="sign-btn" id="sign-up">Sign Up</button>
            <button class="login-btn" id="login-btn">Login</button>
         </div>

    </div>
    <div class="main-section">
        <h1>Privacy Policy</h1>
        <p>This Privacy Policy describes how Las Pinas Job Portal ("we," "us," or "our") collects, uses, and protects your personal information when you use our website and services. By using our services, you agree to the terms of this Privacy Policy.</p>

        <h2>Information We Collect</h2>
        <p>We collect information you provide directly to us, such as when you create an account, apply for a job, or contact us. This may include your name, email address, phone number, resume, and other information you choose to share.</p>

        <h2>How We Use Your Information</h2>
        <p>We use your information to provide and improve our services, including connecting job seekers with employers, personalizing your experience, and communicating with you about job opportunities and updates.</p>

        <h2>Information Sharing</h2>
        <p>We may share your information with employers when you apply for a job. We may also share information with service providers who assist us in operating our website and services. We do not sell your personal information to third parties.</p>

        <h2>Data Security</h2>
        <p>We take reasonable measures to protect your personal information from unauthorized access, use, or disclosure. However, no method of transmission over the internet or electronic storage is completely secure.</p>

        <h2>Your Rights</h2>
        <p>You have the right to access, correct, or delete your personal information. You may also have the right to object to or restrict certain processing of your information. Please contact us if you wish to exercise these rights.</p>

        <h2>Changes to This Policy</h2>
        <p>We may update this Privacy Policy from time to time. We will notify you of any significant changes by posting the new policy on our website.</p>

        <h2>Contact Us</h2>
        <p>If you have any questions about this Privacy Policy, please contact us at privacy@laspinas.com.</p>
    </div>

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