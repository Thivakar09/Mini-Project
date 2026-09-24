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

    <title>Quiz Trivia - Home</title>

    <link rel="stylesheet"
          href="css/style.css">

</head>

<body>


    <!-- ================================
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



    <!-- ================================
         HERO SECTION
         ================================= -->

    <section class="hero">

        <div class="hero-content">

            <h1>
                Welcome to Quiz Trivia
            </h1>

            <p>
                Test your knowledge, challenge yourself,
                and improve your Web Technology skills.
            </p>


            <div class="hero-buttons">

                <a href="quiz.php"
                   class="btn btn-primary">

                    Start Quiz

                </a>


                <?php if (!isLoggedIn()): ?>

                    <a href="auth/register.php"
                       class="btn btn-secondary">

                        Create Account

                    </a>

                <?php else: ?>

                    <a href="dashboard.php"
                       class="btn btn-secondary">

                        My Dashboard

                    </a>

                <?php endif; ?>

            </div>

        </div>

    </section>



    <!-- ================================
         ABOUT SECTION
         ================================= -->

    <section class="section fade-in">

        <h2 class="section-title">
            About Quiz Trivia
        </h2>

        <div class="card-container">


            <!-- Card 1 -->

            <div class="card">

                <h3>
                    Test Your Knowledge
                </h3>

                <p>
                    Answer interactive questions and
                    test your understanding of Web Technologies.
                </p>

            </div>


            <!-- Card 2 -->

            <div class="card">

                <h3>
                    Learn & Improve
                </h3>

                <p>
                    Identify your weak areas and improve
                    your knowledge through repeated practice.
                </p>

            </div>


            <!-- Card 3 -->

            <div class="card">

                <h3>
                    Track Your Progress
                </h3>

                <p>
                    Registered users can save their quiz
                    scores and monitor their performance.
                </p>

            </div>

        </div>

    </section>



    <!-- ================================
         QUIZ TOPICS
         ================================= -->

    <section class="section">

        <h2 class="section-title">
            Quiz Topics
        </h2>


        <div class="card-container">


            <!-- HTML -->

            <div class="card slide-in">

                <div class="card-image">

                    <img
                        src="images/html.jpg"
                        alt="HTML Quiz"
                        style="width:100%; border-radius:10px;"
                    >

                </div>

                <h3>
                    HTML
                </h3>

                <p>
                    Test your knowledge of HTML structure,
                    elements and web page creation.
                </p>

            </div>


            <!-- CSS -->

            <div class="card slide-in">

                <div class="card-image">

                    <img
                        src="images/css.jpg"
                        alt="CSS Quiz"
                        style="width:100%; border-radius:10px;"
                    >

                </div>

                <h3>
                    CSS
                </h3>

                <p>
                    Challenge yourself with questions about
                    CSS styling, layouts and responsive design.
                </p>

            </div>


            <!-- JavaScript -->

            <div class="card slide-in">

                <div class="card-image">

                    <img
                        src="images/javascript.jpg"
                        alt="JavaScript Quiz"
                        style="width:100%; border-radius:10px;"
                    >

                </div>

                <h3>
                    JavaScript
                </h3>

                <p>
                    Explore JavaScript concepts including
                    variables, functions and events.
                </p>

            </div>

        </div>

    </section>



    <!-- ================================
         HOW IT WORKS
         ================================= -->

    <section class="section">

        <h2 class="section-title">
            How It Works
        </h2>


        <div class="card-container">


            <div class="card">

                <h3>
                    01. Register
                </h3>

                <p>
                    Create an account using your username,
                    email and password.
                </p>

            </div>


            <div class="card">

                <h3>
                    02. Start Quiz
                </h3>

                <p>
                    Select the quiz and answer the
                    questions within the given time.
                </p>

            </div>


            <div class="card">

                <h3>
                    03. View Score
                </h3>

                <p>
                    Complete the quiz and view your
                    final score.
                </p>

            </div>


            <div class="card">

                <h3>
                    04. Track Progress
                </h3>

                <p>
                    View your previous attempts and
                    monitor your performance.
                </p>

            </div>

        </div>

    </section>



    <!-- ================================
         CALL TO ACTION
         ================================= -->

    <section class="section">

        <div class="result-box">

            <h2>
                Ready to Challenge Yourself?
            </h2>

            <p>
                Start the Quiz Trivia challenge now!
            </p>

            <br>

            <a href="quiz.php"
               class="btn btn-primary">

                Start Quiz Now

            </a>

        </div>

    </section>



    <!-- ================================
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