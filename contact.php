<?php

require_once "includes/db.php";

$message = "";
$messageType = "";


/* =========================================
   CONTACT FORM SUBMISSION
   ========================================= */

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $userMessage = trim($_POST["message"] ?? "");


    /* Validation */

    if (
        empty($name) ||
        empty($email) ||
        empty($userMessage)
    ) {

        $message = "Please fill in all fields.";
        $messageType = "error";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $message = "Please enter a valid email address.";
        $messageType = "error";

    } else {

        /* Insert message into database */

        $stmt = $conn->prepare(
            "INSERT INTO messages (name, email, message)
             VALUES (?, ?, ?)"
        );

        $stmt->bind_param(
            "sss",
            $name,
            $email,
            $userMessage
        );


        if ($stmt->execute()) {

            $message =
                "Your message has been sent successfully!";

            $messageType = "success";

        } else {

            $message =
                "Something went wrong. Please try again.";

            $messageType = "error";

        }

        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Contact - Quiz Trivia</title>

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

                <?php if (isset($_SESSION["user_id"])): ?>

                    <a href="dashboard.php">
                        Dashboard
                    </a>

                    <a href="auth/logout.php">
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
         CONTACT HERO
         ================================= -->

    <section class="hero">

        <div class="hero-content">

            <h1>
                Contact Us
            </h1>

            <p>
                Have a question or suggestion?
                Send us a message.
            </p>

        </div>

    </section>



    <!-- =================================
         CONTACT FORM
         ================================= -->

    <section class="section">

        <h2 class="section-title">
            Send Us a Message
        </h2>


        <div class="form-container">


            <?php if (!empty($message)): ?>

                <div
                    class="alert
                    <?php
                    echo
                    $messageType === "success"
                    ? "alert-success"
                    : "alert-error";
                    ?>">

                    <?php echo htmlspecialchars($message); ?>

                </div>

            <?php endif; ?>


            <form
                method="POST"
                action="contact.php"
                onsubmit="return validateForm(this);">


                <!-- Name -->

                <div class="form-group">

                    <label for="name">
                        Name
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control"
                        placeholder="Enter your name"
                        required>

                </div>


                <!-- Email -->

                <div class="form-group">

                    <label for="email">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        placeholder="Enter your email"
                        required>

                </div>


                <!-- Message -->

                <div class="form-group">

                    <label for="message">
                        Message
                    </label>

                    <textarea
                        id="message"
                        name="message"
                        class="form-control"
                        rows="6"
                        placeholder="Write your message here..."
                        required></textarea>

                </div>


                <!-- Submit -->

                <button
                    type="submit"
                    class="btn btn-primary">

                    Send Message

                </button>

            </form>

        </div>

    </section>



    <!-- =================================
         CONTACT INFORMATION
         ================================= -->

    <section class="section">

        <h2 class="section-title">
            Get in Touch
        </h2>


        <div class="card-container">


            <div class="card">

                <h3>
                    Email
                </h3>

                <p>
                    quiztrivia@example.com
                </p>

            </div>


            <div class="card">

                <h3>
                    Support
                </h3>

                <p>
                    Send us your questions and
                    suggestions using the contact form.
                </p>

            </div>


            <div class="card">

                <h3>
                    Feedback
                </h3>

                <p>
                    Your feedback helps us improve
                    the Quiz Trivia application.
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


    <script src="js/script.js"></script>

</body>

</html>