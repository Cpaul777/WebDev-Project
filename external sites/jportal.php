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
    <link rel="stylesheet" href="jportal.css">
</head>
<body>
    <div class="top-menu">
         <div class="las-pinas">
            <i class="bi bi-bank2"></i>
            <h2> Las Piñas Job Portal</h2>
         </div>
         <div class="tabs">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Jobs</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
         </div>
        
         <div class="right-side">
            <button class="sign-btn">Sign Up</button>
            <button class="login-btn">Login</button>
         </div>

    </div>
    <div class="main-section">
        <h1>Good  Day, Las  Piñeros!</h1>
        <div class="middle-card">
            <h2>Find Your Dream Job in Las Piñas</h2>
            <p>Explore a wide range of job opportunities in the City of Las Piñas. We connect talented individuals with leading employers in the region.</p>

            <div class="search-bar">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Search for jobs">
                <button type="submit">Search</button>
            </div>
        </div>

        <div class="job-featured">
            <h2>Featured Jobs</h2>
            <ul>
                <li><a href="#"><img src="../img/finance_job.jpg" alt="">
                <h4>Finance Officer</h4>
                <p></p>
                </a></li>
                <li><a href="#"><img src="../img/assistant.jpg" alt="">
                <h4>Administrative Assistant</h4>
                </a></li>
                <li><a href="#"><img src="../img/clerk.jpg" alt="">
                <h4>Assistant Clerk</h4>
                </a></li>
            </ul>
        </div>
        <div class="job-category">
            <h2>Job Categories</h2>
            <ul>
                <li><a href="#"><img src="../img/public_safety.jpeg" alt="">Public Safety</a></li>
                <li><a href="#"><img src="../img/administrative_city.jpeg" alt="">Administration</a></li>
                <li><a href="#"><img src="../img/com_service.jpg" alt="">Community Service</a></li>
                <li><a href="#"><img src="../img/finance_holder.jpg" alt="">Finance</a></li>
                <li><a href="#"><img src="../img/hr_job.png" alt="">Human Resources</a></li>
            </ul>
        </div>
    </div>
    
    <div class="overlay">
        <div class="modal">
            <img src="../img/logo-laspinas.png" alt="">
            <h2>Welcome to Las Piñas Job Portal</h2>
            <div class="tabs">
                <button class="sign-in-btn active">Sign In</button>
                <button class="register-btn">Register</button>
            </div>
            
            <div class="sign-in active">
            <form action="#" method="post">
                <input type="email" placeholder="Email" required>
                <input type="password" placeholder="Password" required>
                <a href="">Forgot Password</a>
                <br>
                <button type="submit">Sign-in</button>
            </form>
            <p>By Signing in, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.</p>
            </div>
            <div class="register">
                <form action="#" method="post">
                    <input type="text" placeholder="Full Name" required>
                    <input type="email" placeholder="Email" required>
                    <input type="password" placeholder="Password" required>
                    <input type="password" placeholder="Confirm Password" required>
                    <button type="submit">Register</button>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-links">
            <ul>
                <li><a href="">About Us</a></li>
                <li><a href="">Contact</a></li>
                <li><a href="">Privacy Policy</a></li>
                <li><a href="">Terms of Service</a></li>
                
            </ul>
        </div>
        <p>&copy;2024 Las Pinas Job Portal. All rights reserved.</p>
</body>
</html>