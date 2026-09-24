<?php

require_once "includes/db.php";
require_once "includes/functions.php";

/* User must be logged in */
requireLogin();

$userId = getUserId();
$username = getUsername();

/* Get user statistics */
$totalAttempts = getQuizAttempts($conn, $userId);
$bestScore = getBestScore($conn, $userId);
$averageScore = getAverageScore($conn, $userId);


/* Get quiz history */

$quizHistory = [];

$stmt = $conn->prepare(
    "SELECT score, total_questions, created_at
     FROM quiz_scores
     WHERE user_id = ?
     ORDER BY created_at DESC"
);

$stmt->bind_param("i", $userId);
$stmt->execute();

$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $quizHistory[] = $row;
}

$stmt->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Quiz Trivia</title>

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

                <a href="quiz.php">
                    Quiz
                </a>

                <a href="features.php">
                    Features
                </a>

                <a href="contact.php">
                    Contact
                </a>

                <a href="auth/logout.php"
                   onclick="return confirmLogout();">

                    Logout

                </a>

            </div>

        </div>

    </nav>



    <!-- =================================
         DASHBOARD
         ================================= -->

    <section class="section">

        <div class="dashboard">


            <!-- Welcome -->

            <div class="dashboard-header">

                <h1>
                    Welcome, <?php echo clean($username); ?>!
                </h1>

                <p>
                    Here you can view your Quiz Trivia
                    performance and previous attempts.
                </p>

            </div>



            <!-- Statistics -->

            <div class="stats-container">


                <!-- Total Attempts -->

                <div class="stat-card">

                    <h3>
                        Total Attempts
                    </h3>

                    <div class="stat-number">
                        <?php echo $totalAttempts; ?>
                    </div>

                    <p>
                        Quiz attempts
                    </p>

                </div>


                <!-- Best Score -->

                <div class="stat-card">

                    <h3>
                        Best Score
                    </h3>

                    <div class="stat-number">
                        <?php echo $bestScore; ?>/10
                    </div>

                    <p>
                        Highest score
                    </p>

                </div>


                <!-- Average Score -->

                <div class="stat-card">

                    <h3>
                        Average Score
                    </h3>

                    <div class="stat-number">
                        <?php echo $averageScore; ?>
                    </div>

                    <p>
                        Average marks
                    </p>

                </div>

            </div>



            <!-- Start Quiz -->

            <div class="result-box">

                <h2>
                    Ready for Another Challenge?
                </h2>

                <p>
                    Improve your score by taking
                    the quiz again.
                </p>

                <br>

                <a href="quiz.php"
                   class="btn btn-primary">

                    Start Quiz

                </a>

            </div>



            <!-- Quiz History -->

            <section class="section">

                <h2 class="section-title">
                    Quiz History
                </h2>


                <?php if (count($quizHistory) > 0): ?>

                    <div class="table-container">

                        <table class="data-table">

                            <thead>

                                <tr>

                                    <th>
                                        No.
                                    </th>

                                    <th>
                                        Score
                                    </th>

                                    <th>
                                        Percentage
                                    </th>

                                    <th>
                                        Date
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                <?php
                                $number = 1;

                                foreach ($quizHistory as $attempt):

                                    $score =
                                        (int)$attempt["score"];

                                    $total =
                                        (int)$attempt["total_questions"];

                                    $percentage = 0;

                                    if ($total > 0) {
                                        $percentage =
                                            round(
                                                ($score / $total) * 100,
                                                2
                                            );
                                    }
                                ?>

                                    <tr>

                                        <td>
                                            <?php echo $number; ?>
                                        </td>

                                        <td>
                                            <?php
                                            echo $score . " / " . $total;
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                            echo $percentage . "%";
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                            echo formatDate(
                                                $attempt["created_at"]
                                            );
                                            ?>
                                        </td>

                                    </tr>

                                <?php

                                    $number++;

                                endforeach;

                                ?>

                            </tbody>

                        </table>

                    </div>

                <?php else: ?>

                    <div class="card">

                        <h3>
                            No Quiz Attempts Yet
                        </h3>

                        <p>
                            You have not completed a quiz yet.
                            Start your first quiz now!
                        </p>

                        <br>

                        <a href="quiz.php"
                           class="btn btn-primary">

                            Take Your First Quiz

                        </a>

                    </div>

                <?php endif; ?>

            </section>


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



    <script src="js/script.js"></script>

</body>

</html>