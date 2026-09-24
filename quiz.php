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

    <title>Quiz - Quiz Trivia</title>

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
         QUIZ SECTION
         ================================= -->

    <section class="section">

        <h1 class="section-title">
            Web Technology Quiz
        </h1>

        <p style="text-align:center; margin-bottom:25px;">
            Test your knowledge of HTML, CSS, JavaScript
            and Web Technologies.
        </p>


        <div class="quiz-container">


            <!-- Quiz Header -->

            <div class="quiz-header">

                <div class="question-number">
                    Question
                    <span id="current-question">
                        1
                    </span>
                    /
                    <span id="total-questions">
                        10
                    </span>
                </div>


                <div class="timer">
                    Time:
                    <span id="timer">
                        60
                    </span>
                    s
                </div>

            </div>


            <!-- Progress Bar -->

            <div class="progress-container">

                <div
                    class="progress-bar"
                    id="progress-bar"
                    style="width:10%;">

                </div>

            </div>


            <!-- Question -->

            <div class="question">

                <h2 id="question-text">
                    Loading question...
                </h2>

            </div>


            <!-- Options -->

            <div class="options"
                 id="options-container">

                <!-- JavaScript will add options here -->

            </div>


            <!-- Quiz Buttons -->

            <div class="quiz-buttons">

                <button
                    type="button"
                    class="btn btn-secondary"
                    id="previous-btn"
                    onclick="previousQuestion();"
                    style="display:none;">

                    Previous

                </button>


                <button
                    type="button"
                    class="btn btn-primary"
                    id="next-btn"
                    onclick="nextQuestion();">

                    Next

                </button>

            </div>


            <!-- Result -->

            <div
                class="result-box"
                id="result-box"
                style="display:none;">

                <h2>
                    Quiz Completed!
                </h2>

                <p>
                    Your Score:
                </p>

                <h1 id="final-score">
                    0 / 10
                </h1>

                <p id="score-message">
                    Good job!
                </p>


                <div style="margin-top:20px;">

                    <button
                        type="button"
                        class="btn btn-primary"
                        onclick="startQuiz();">

                        Try Again

                    </button>


                    <?php if (isLoggedIn()): ?>

                        <a
                            href="dashboard.php"
                            class="btn btn-secondary">

                            View Dashboard

                        </a>

                    <?php else: ?>

                        <a
                            href="auth/register.php"
                            class="btn btn-secondary">

                            Register to Save Score

                        </a>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </section>



    <!-- =================================
         QUIZ INFORMATION
         ================================= -->

    <section class="section">

        <h2 class="section-title">
            Quiz Information
        </h2>


        <div class="card-container">


            <div class="card">

                <h3>
                    10 Questions
                </h3>

                <p>
                    This quiz contains 10 questions
                    related to Web Technologies.
                </p>

            </div>


            <div class="card">

                <h3>
                    Time Limit
                </h3>

                <p>
                    You have 60 seconds to complete
                    the quiz.
                </p>

            </div>


            <div class="card">

                <h3>
                    Instant Result
                </h3>

                <p>
                    Your score will be displayed
                    immediately after completing the quiz.
                </p>

            </div>

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


    <!-- Start Quiz -->

    <script>

        document.addEventListener(
            "DOMContentLoaded",
            function () {

                startQuiz();

            }
        );

    </script>

</body>

</html>