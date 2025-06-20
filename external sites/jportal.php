<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>

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
            <h2> <a href="jportal.php">

                Las Piñas Job Portal

                </a>
            </h2>
         </div>
         <div class="tabs">
            <ul>
                <li><a href="jportal.php" class="active">Home</a></li>
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
                <button class="sign-in-btn" id="sign-in-tab">Sign In</button>
                <button class="register-btn" id="register-tab">Register</button>
            </div>
            
            <div class="sign-in">
            <form action="#" method="post">
                <input type="email" placeholder="Email" required>
                <input type="password" placeholder="Password" required>
                <a href="">Forgot Password</a>
                <br>
                <button type="submit">Sign-in</button>
            </form>
            
            </div>
            <div class="register">
                <form action="#" method="post">
                    <input type="text" placeholder="Full Name" required>
                    <input type="email" placeholder="Email" required>
                    <input type="password" placeholder="Password" required>
                    <input type="password" placeholder="Confirm Password" required>
                    <br>
                    <button type="submit">Register</button>
                </form>
            </div>
            <p>By Signing in, you agree to our <a href="#" id="show-terms">Terms of Service and Privacy Policy</a></p>

            <!-- Terms Modal -->
            <div class="terms-modal" id="terms-modal">
                <div class="terms-content">
                    
                    <h2>Terms of Service and Privacy Policy</h2>
                    <div class="terms-scroll">
                        <h3>Terms of Service</h3>
                        <h5>1. Acceptance of Terms</h5>
                        <p>By using Las Piñas Smart City to pay for your online purchases, you hereby agree to be unconditionally bound by the Terms of Service of its use as stated in this document.
                            
                        The Terms of Service contained herein are governed by laws of the Republic of the Philippines and all suits to enforce this Agreement will have to be settled in the proper courts of the City of Las Piñas.
                        </p>
                        <h5>2. Account Registration</h5>
                        <p>Users may create an account solely for the purpose of submitting job applications. You are responsible for maintaining the confidentiality of your account and ensuring that all information you provide is accurate.</p>

                        <h5>3. User Conduct</h5>
                        <p>You agree not to:</p>
                        <ul>
                            <li>Use false or misleading information</li>
                            <li>Submit inappropriate content or documents</li>
                            <li>Impersonate another person</li>
                        </ul>

                        <p>Attempt to compromise the website’s security</p>

                        <h5>4. Intellectual Property</h5>
                        <p>All content on this Website, including logos, graphics, and text, is owned by [Your Website Name] and protected by intellectual property laws.</p>

                        <h5>5. Job Application Disclaimer</h5>
                        <p>We do not guarantee employment or response to every application. The final hiring decisions are made by the companies or HR staff reviewing your submissions.</p>

                        <h5>6. Modifications</h5>
                        <p>We reserve the right to update or change these Terms at any time. Continued use of the Website after changes means you accept the new terms.</p>

                        <h5>7. Governing Law</h5>
                        <p>These Terms are governed by the laws of Philippines.</p>

                        <a class="close-terms" id="close-terms" aria-label="Close">Agree</a>
                    </div>
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
        <script>

            const overlay = document.querySelector('.overlay');
            const signUpButton = document.getElementById('sign-up');
            const loginButton = document.getElementById('login-btn');
            const signInTab = document.getElementById('sign-in-tab');
            const registerTab = document.getElementById('register-tab');
            const signInForm = document.querySelector('.sign-in');
            const registerForm = document.querySelector('.register');

            const termsModal = document.getElementById('terms-modal');
            const showTerms = document.getElementById('show-terms');
            const closeTerms = document.getElementById('close-terms');
           

            signUpButton.addEventListener('click', function() {
                toggleOverlay();
                switchToRegister();
                signInTab.classList.remove('active');
                registerTab.classList.add('active');
            });

            loginButton.addEventListener('click', function() {
                toggleOverlay();
                switchToSignIn();
                signInTab.classList.add('active');
                registerTab.classList.remove('active');
            });

            function switchToSignIn() {
                signInForm.classList.add('active');
                registerForm.classList.remove('active');
            }

            function switchToRegister() {
                registerForm.classList.add('active');
                signInForm.classList.remove('active');
            }

            signInTab.addEventListener('click', function() {
                switchToSignIn();
                signInTab.classList.add('active');
                registerTab.classList.remove('active');
            });

            registerTab.addEventListener('click', function() {
                switchToRegister();
                registerTab.classList.add('active');
                signInTab.classList.remove('active');
            });

            function toggleOverlay() {
                if (overlay.style.display === 'flex') {
                    overlay.style.display = 'none';
                } else {
                    overlay.style.display = 'flex';
                }   
            }

            document.querySelector('.overlay').addEventListener('click', function(event) {
                if (event.target === this) {
                    console.log('Overlay clicked');
                    toggleOverlay();
                }
            });

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                   toggleOverlay();
                }
            });

             // Show Terms Modal
            showTerms.addEventListener('click', function(e) {
                e.preventDefault();
                termsModal.style.display = 'flex';
            });

            closeTerms.addEventListener('click', function() {
                termsModal.style.display = 'none';
            });

            termsModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    termsModal.style.display = 'none';
                }
            });

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && termsModal.style.display === 'flex') {
                    termsModal.style.display = 'none';
                }
            });


        </script>
</body>
</html>