<?php

require_once "includes/db.php";
require_once "includes/functions.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Features - Quiz Trivia</title>

    <link rel="stylesheet"
          href="css/style.css">

</head>

<body>


    <!-- =================================
         NAVIGATION
         ================================= -->

    <nav class="navbar">

        <div class="navbar-container">

            <a href="index.php" class="logo">
                Quiz Trivia
            </a>

            <div class="nav-links">

                <a href="index.php">
                    Home
                </a>

                <a href="features.php">
                    Features
                </a>

                <a href="contact.php">
                    Contact
                </a>

                <?php if (isLoggedIn()): ?>

                    <a href="dashboard.php">
                        Dashboard
                    </a>

                    <a href="auth/logout.php"
                       onclick="return confirmLogout();">
                        Logout
                    </a>

                <?php else: ?>

                    <a href="auth/login.php">
                        Login
                    </a>

                    <a href="auth/register.php">
                        Register
                    </a>

                <?php endif; ?>

            </div>

        </div>

    </nav>



    <!-- =================================
         HERO
         ================================= -->

    <section class="hero">

        <div class="hero-content">

            <h1>
                Quiz Trivia Features
            </h1>

            <p>
                Explore the features that make our
                Quiz Trivia Web Application interactive,
                useful and easy to use.
            </p>

            <a href="quiz.php"
               class="btn btn-primary">

                Try the Quiz

            </a>

        </div>

    </section>



    <!-- =================================
         MAIN FEATURES
         ================================= -->

    <section class="section">

        <h2 class="section-title">
            Main Features
        </h2>


        <div class="card-container">


            <!-- Feature 1 -->

            <div class="card fade-in">

                <h3>
                    Interactive Quiz
                </h3>

                <p>
                    Answer multiple-choice questions
                    and interact with the quiz dynamically
                    using JavaScript.
                </p>

            </div>


            <!-- Feature 2 -->

            <div class="card fade-in">

                <h3>
                    Time Challenge
                </h3>

                <p>
                    A countdown timer creates a challenging
                    environment and helps users test their
                    knowledge within a limited time.
                </p>

            </div>


            <!-- Feature 3 -->

            <div class="card fade-in">

                <h3>
                    Instant Results
                </h3>

                <p>
                    Users can immediately see their score
                    after completing the quiz.
                </p>

            </div>


            <!-- Feature 4 -->

            <div class="card fade-in">

                <h3>
                    User Registration
                </h3>

                <p>
                    Users can create an account using their
                    username, email and password.
                </p>

            </div>


            <!-- Feature 5 -->

            <div class="card fade-in">

                <h3>
                    Secure Login
                </h3>

                <p>
                    Registered users can securely log in
                    and access their personal dashboard.
                </p>

            </div>


            <!-- Feature 6 -->

            <div class="card fade-in">

                <h3>
                    Score Tracking
                </h3>

                <p>
                    Quiz scores can be stored in the database
                    and displayed through the user dashboard.
                </p>

            </div>


            <!-- Feature 7 -->

            <div class="card fade-in">

                <h3>
                    Responsive Design
                </h3>

                <p>
                    The application is designed to work on
                    desktops, tablets and mobile phones.
                </p>

            </div>


            <!-- Feature 8 -->

            <div class="card fade-in">

                <h3>
                    Contact Form
                </h3>

                <p>
                    Users can send questions, suggestions
                    or feedback through the contact form.
                </p>

            </div>

        </div>

    </section>



    <!-- =================================
         TECHNOLOGY USED
         ================================= -->

    <section class="section">

        <h2 class="section-title">
            Technologies Used
        </h2>


        <div class="card-container">


            <div class="card slide-in">

                <h3>
                    HTML
                </h3>

                <p>
                    Used to create the structure and
                    content of the web pages.
                </p>

            </div>


            <div class="card slide-in">

                <h3>
                    CSS
                </h3>

                <p>
                    Used to design the layout, colours,
                    buttons, cards and responsive interface.
                </p>

            </div>


            <div class="card slide-in">

                <h3>
                    Bootstrap
                </h3>

                <p>
                    Can be used to support responsive
                    layouts and user interface components.
                </p>

            </div>


            <div class="card slide-in">

                <h3>
                    JavaScript
                </h3>

                <p>
                    Used for quiz interaction, timer,
                    dynamic content and form validation.
                </p>

            </div>


            <div class="card slide-in">

                <h3>
                    PHP
                </h3>

                <p>
                    Used for server-side processing,
                    authentication and database operations.
                </p>

            </div>


            <div class="card slide-in">

                <h3>
                    MySQL
                </h3>

                <p>
                    Used to store user information,
                    quiz scores and contact messages.
                </p>

            </div>

        </div>

    </section>



    <!-- =================================
         WHY USE QUIZ TRIVIA
         ================================= -->

    <section class="section">

        <h2 class="section-title">
            Why Use Quiz Trivia?
        </h2>


        <div class="result-box">

            <h2>
                Learn While You Play
            </h2>

            <p>
                Quiz Trivia provides an interactive way
                to test your Web Technology knowledge.
                Users can answer questions, receive instant
                results and track their progress.
            </p>

            <br>

            <a href="quiz.php"
               class="btn btn-primary">

                Start Quiz

            </a>

        </div>

    </section>



    <!-- =================================
         FOOTER
         ================================= -->

    <footer class="footer">

        <p>
            &copy; 2026 Quiz Trivia Web Application
        </p>

        <p>
            Developed for ICT 2209 - Web Technologies
        </p>

    </footer>



    <!-- JavaScript -->

    <script src="js/script.js"></script>

</body>

</html>