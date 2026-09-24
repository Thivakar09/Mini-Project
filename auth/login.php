<?php

require_once "../includes/db.php";
require_once "../includes/functions.php";

$message = "";
$messageType = "";


/* =========================================
   LOGIN PROCESS
   ========================================= */

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = clean($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";


    /* Validation */

    if ($email === "" || $password === "") {

        $message = "Please enter your email and password.";
        $messageType = "error";

    } elseif (!isValidEmail($email)) {

        $message = "Please enter a valid email address.";
        $messageType = "error";

    } else {

        /* Find user */

        $stmt = $conn->prepare(
            "SELECT id, username, email, password
             FROM users
             WHERE email = ?"
        );

        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();


        if ($result->num_rows === 1) {

            $user = $result->fetch_assoc();


            /* Verify password */

            if (password_verify($password, $user["password"])) {

                /* Create session */

                $_SESSION["user_id"] = $user["id"];
                $_SESSION["username"] = $user["username"];
                $_SESSION["email"] = $user["email"];


                /* Redirect to dashboard */

                header("Location: ../dashboard.php");
                exit();

            } else {

                $message = "Incorrect email or password.";
                $messageType = "error";
            }

        } else {

            $message = "Incorrect email or password.";
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

    <title>Login - Quiz Trivia</title>

    <link rel="stylesheet"
          href="../css/style.css">

</head>

<body>


    <!-- Navigation -->

    <nav class="navbar">

        <div class="navbar-container">

            <a href="../index.php" class="logo">
                Quiz Trivia
            </a>

            <div class="nav-links">

                <a href="../index.php">
                    Home
                </a>

                <a href="register.php">
                    Register
                </a>

            </div>

        </div>

    </nav>


    <!-- Login Section -->

    <section class="section">

        <div class="form-container">

            <h1 class="section-title">
                Login
            </h1>

            <p style="text-align:center; margin-bottom:25px;">
                Login to access your Quiz Trivia dashboard.
            </p>


            <!-- Error / Success Message -->

            <?php if ($message !== ""): ?>

                <div class="alert <?php echo $messageType === "success"
                    ? "alert-success"
                    : "alert-error"; ?>">

                    <?php echo $message; ?>

                </div>

            <?php endif; ?>


            <!-- Login Form -->

            <form method="POST"
                  action=""
                  onsubmit="return validateForm(this);">


                <!-- Email -->

                <div class="form-group">

                    <label for="email">
                        Email Address
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        placeholder="Enter your email"
                        required
                    >

                </div>


                <!-- Password -->

                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Enter your password"
                        required
                    >

                </div>


                <!-- Login Button -->

                <button
                    type="submit"
                    class="btn btn-primary"
                    style="width:100%;">

                    Login

                </button>

            </form>


            <!-- Register Link -->

            <p style="text-align:center; margin-top:20px;">

                Don't have an account?

                <a href="register.php">
                    Register here
                </a>

            </p>

        </div>

    </section>


    <!-- Footer -->

    <footer class="footer">

        <p>
            &copy; 2026 Quiz Trivia Web Application
        </p>

    </footer>


    <script src="../js/script.js"></script>

</body>

</html>