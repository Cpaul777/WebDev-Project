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
        
         <!-- <div class="right-side">
            <button class="sign-btn" id="sign-up">Sign Up</button>
            <button class="login-btn" id="login-btn">Login</button>
         </div> -->

    </div>
    <div class="main-section">
        <h1>Terms of Service</h1>
        <h2>Acceptance of Terms</h2>
        <p>By accessing or using the Las Pinas Job Portal platform, you agree to be bound by these Terms of Service. If you do not agree to these terms, please do not use our services.</p>

        <h2>User Responsibilities</h2>
        <p>As a user of Las Pinas Job Portal, you are responsible for maintaining the confidentiality of your account information and for all activities that occur under your account. You agree to provide accurate and complete information when creating your profile and applying for jobs.</p>

        <h2>Acceptable Use</h2>
        <p>You agree to use Las Pinas Job Portal only for lawful purposes and in a manner that does not infringe the rights of, restrict, or inhibit anyone else's use and enjoyment of the platform. Prohibited activities include, but are not limited to, posting false or misleading information, harassing other users, and violating any applicable laws or regulations.</p>

        <h2>Intellectual Property</h2>
        <p>All content and materials available on Las Pinas Job Portal, including but not limited to text, graphics, logos, and software, are the property of Las Pinas Job Portal or its licensors and are protected by copyright, trademark, and other intellectual property laws.</p>

        <h2>Disclaimer of Warranties</h2>
        <p>Las Pinas Job Portal provides its services on an "as is" and "as available" basis. We make no warranties, express or implied, regarding the operation or availability of our services, or the accuracy, reliability, or content of any information provided.</p>

        <h2>Limitation of Liability</h2>
        <p>In no event shall Las Pinas Job Portal be liable for any direct, indirect, incidental, special, or consequential damages arising out of or in connection with your use of our services, even if we have been advised of the possibility of such damages.</p>

        <h2>Changes to Terms</h2>
        <p>JobFinder reserves the right to modify these Terms of Service at any time. We will notify users of any significant changes by posting the updated terms on our platform. Your continued use of Las Pinas Job Portal after such changes constitutes your acceptance of the new terms.</p>

        <h2>Governing Law</h2>
        <p>These Terms of Service shall be governed by and construed in accordance with the laws of the Philippines, without regard to its conflict of law principles.</p>

        <h2>Contact Us</h2>
        <p>If you have any questions or concerns about these Terms of Service, please contact us at support@Laspinas.com.</p>
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