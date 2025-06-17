<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>

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
            max-width: 1300px;
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

        .main-section h2 {
            font-size: 2rem;
            color: var(--dark-green);
            margin-bottom: 16px;
        }

        .main-section p {
            font-size: 1.2rem;
            color: var(--dark-color);
            line-height: 1.6;
            margin-bottom: 20px;
        }

        /* Contact Page Custom Styles */
        .contact-section {
            max-width: 1250px;
            margin: 32px auto 0 auto;
            padding: 32px 20px 20px 20px;
            background: var(--bg-color);
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
        }
        .contact-section h1 {
            color: var(--dark-color);
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .contact-section .contact-sub {
            color: #4D994F;
            font-size: 1rem;
            margin-bottom: 2.2rem;
        }
        .contact-general {
            display: flex;
            gap: 40px;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }
        .contact-col {
            flex: 1 1 300px;
            min-width: 220px;
        }
        .contact-label {
            font-weight: 600;
            color: #4D994F;
            margin-bottom: 2px;
            margin-top: 18px;
        }
        .contact-value {
            color: #222;
            font-size: 1.05rem;
            margin-bottom: 8px;
        }
        .contact-divider {
            border: none;
            border-top: 1px solid #e0e0e0;
            margin: 24px 0 18px 0;
        }
        .contact-specific {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
            margin-bottom: 18px;
        }
        .contact-spec-col {
            flex: 1 1 220px;
            min-width: 180px;
        }
        .contact-social {
            margin-top: 18px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .contact-social-icons-labels {
            display: flex;
            gap: 38px;
            margin-bottom: 0;
        }
        .contact-social-icon-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }
        .contact-social-icons-labels a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--other-white);
            color: var(--dark-color);
            font-size: 1.5rem;
            transition: background 0.2s, color 0.2s;
            text-decoration: none;
            margin-bottom: 4px;
        }
        .contact-social-icons-labels a:hover {
            background: var(--light-green);
            color: var(--white-color);
        }
        .contact-social-icons-labels span {
            color: #444;
            font-size: 0.98rem;
            margin-top: 2px;
        }
        @media (max-width: 900px) {
            .contact-general, .contact-specific {
                flex-direction: column;
                gap: 0;
            }
            .contact-social-icons-labels {
                gap: 18px;
            }
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
                <li><a href="about.php" >About</a></li>
                <li><a href="contact.php" class="active">Contact</a></li>
            </ul>
         </div>
        
         <div class="right-side">
            <button class="sign-btn" id="sign-up">Sign Up</button>
            <button class="login-btn" id="login-btn">Login</button>
         </div>

    </div>
    <div class="main-section contact-section">
        <h1>Contact Us</h1>
        <p class="contact-sub">For inquiries regarding job postings and the application process in Las Piñas, please reach out to us using the contact information below.</p>
        <div class="contact-general">
            <div class="contact-col">
                <div class="contact-label">Email</div>
                <div class="contact-value">laspinascitygov@yahoo.com</div>
                <div class="contact-label">Address</div>
                <div class="contact-value">123 Main Street, Las Piñas City, Philippines</div>
            </div>
            <div class="contact-col">
                <div class="contact-label">Phone</div>
                <div class="contact-value">+63 988 051 4877</div>
            </div>
        </div>
        <hr class="contact-divider">
        <div class="contact-specific">
            <div class="contact-spec-col">
                <div class="contact-label">Job Postings</div>
                <div class="contact-value">postings@laspinas.gov</div>
            </div>
            <div class="contact-spec-col">
                <div class="contact-label">Application Process</div>
                <div class="contact-value">applications@laspinas.gov</div>
            </div>
            <div class="contact-spec-col">
                <div class="contact-label">Technical Support</div>
                <div class="contact-value">support@laspinas.gov</div>
            </div>
        </div>
        <hr class="contact-divider">
        <div class="contact-social">
            <div class="contact-label">Social Media</div>
            <div class="contact-social-icons-labels">
                <div class="contact-social-icon-label">
                    <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <span>Facebook</span>
                </div>
                <div class="contact-social-icon-label">
                    <a href="#" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
                    <span>Twitter</span>
                </div>
                <div class="contact-social-icon-label">
                    <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <span>Instagram</span>
                </div>
            </div>
        </div>
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