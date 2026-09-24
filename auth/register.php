<?php

require_once "../includes/db.php";
require_once "../includes/functions.php";

$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = clean($_POST["username"] ?? "");
    $email = clean($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirmPassword = $_POST["confirm_password"] ?? "";

    /* Validation */

    if ($username === "" || $email === "" || $password === "" || $confirmPassword === "") {

        $message = "Please fill in all fields.";
        $messageType = "error";

    } elseif (!isValidEmail($email)) {

        $message = "Please enter a valid email address.";
        $messageType = "error";

    } elseif (strlen($password) < 6) {

        $message = "Password must contain at least 6 characters.";
        $messageType = "error";

    } elseif ($password !== $confirmPassword) {

        $message = "Passwords do not match.";
        $messageType = "error";

    } else {

        /* Check whether email already exists */

        $stmt = $conn->prepare(
            "SELECT id FROM users WHERE email = ?"
        );

        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            $message = "This email is already registered.";
            $messageType = "error";

        } else {

            /* Hash password */

            $hashedPassword = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            /* Insert new user */

            $stmt = $conn->prepare(
                "INSERT INTO users 
                (username, email, password, created_at)
                VALUES (?, ?, ?, NOW())"
            );

            $stmt->bind_param(
                "sss",
                $username,
                $email,
                $hashedPassword
            );

            if ($stmt->execute()) {

                $message = "Registration successful! You can now login.";
                $messageType = "success";

                $username = "";
                $email = "";

            } else {

                $message = "Registration failed. Please try again.";
                $messageType = "error";
            }
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

    <title>Register - Quiz Trivia</title>

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

                <a href="login.php">
                    Login
                </a>

            </div>

        </div>

    </nav>


    <!-- Registration Section -->

    <section class="section">

        <div class="form-container">

            <h1 class="section-title">
                Create an Account
            </h1>

            <p style="text-align:center; margin-bottom:25px;">
                Register to play quizzes and save your scores.
            </p>


            <!-- Message -->

            <?php if ($message !== ""): ?>

                <div class="alert <?php echo $messageType === "success"
                    ? "alert-success"
                    : "alert-error"; ?>">

                    <?php echo $message; ?>

                </div>

            <?php endif; ?>


            <!-- Registration Form -->

            <form method="POST"
                  action=""
                  onsubmit="return validateForm(this);">

                <!-- Username -->

                <div class="form-group">

                    <label for="username">
                        Username
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        class="form-control"
                        placeholder="Enter your username"
                        value="<?php echo $username ?? ""; ?>"
                        required
                    >

                </div>


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
                        value="<?php echo $email ?? ""; ?>"
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
                        placeholder="Enter password"
                        minlength="6"
                        required
                    >

                </div>


                <!-- Confirm Password -->

                <div class="form-group">

                    <label for="confirm_password">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        id="confirm_password"
                        name="confirm_password"
                        class="form-control"
                        placeholder="Confirm your password"
                        minlength="6"
                        required
                    >

                </div>


                <!-- Register Button -->

                <button type="submit"
                        class="btn btn-primary"
                        style="width:100%;">

                    Register

                </button>

            </form>


            <!-- Login Link -->

            <p style="text-align:center; margin-top:20px;">

                Already have an account?

                <a href="login.php">
                    Login here
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