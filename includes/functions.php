<?php

/* =========================================
   QUIZ TRIVIA WEB APPLICATION
   Common Functions
   ========================================= */

/* Start session if it has not already started */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


/* =========================================
   CHECK USER LOGIN
   ========================================= */

function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}


/* =========================================
   REDIRECT IF NOT LOGGED IN
   ========================================= */

function requireLogin()
{
    if (!isLoggedIn()) {
        header("Location: auth/login.php");
        exit();
    }
}


/* =========================================
   GET CURRENT USER ID
   ========================================= */

function getUserId()
{
    return $_SESSION['user_id'] ?? null;
}


/* =========================================
   GET CURRENT USERNAME
   ========================================= */

function getUsername()
{
    return $_SESSION['username'] ?? "Guest";
}


/* =========================================
   SECURITY FUNCTION
   Prevent XSS attacks
   ========================================= */

function clean($data)
{
    return htmlspecialchars(
        trim($data),
        ENT_QUOTES,
        'UTF-8'
    );
}


/* =========================================
   CHECK EMPTY VALUE
   ========================================= */

function isEmpty($value)
{
    return empty(trim($value));
}


/* =========================================
   VALIDATE EMAIL
   ========================================= */

function isValidEmail($email)
{
    return filter_var(
        $email,
        FILTER_VALIDATE_EMAIL
    );
}


/* =========================================
   SET SUCCESS MESSAGE
   ========================================= */

function setSuccess($message)
{
    $_SESSION['success_message'] = $message;
}


/* =========================================
   SET ERROR MESSAGE
   ========================================= */

function setError($message)
{
    $_SESSION['error_message'] = $message;
}


/* =========================================
   DISPLAY SUCCESS MESSAGE
   ========================================= */

function displaySuccess()
{
    if (isset($_SESSION['success_message'])) {

        echo '<div class="alert alert-success">'
            . clean($_SESSION['success_message'])
            . '</div>';

        unset($_SESSION['success_message']);
    }
}


/* =========================================
   DISPLAY ERROR MESSAGE
   ========================================= */

function displayError()
{
    if (isset($_SESSION['error_message'])) {

        echo '<div class="alert alert-error">'
            . clean($_SESSION['error_message'])
            . '</div>';

        unset($_SESSION['error_message']);
    }
}


/* =========================================
   REDIRECT FUNCTION
   ========================================= */

function redirect($page)
{
    header("Location: " . $page);
    exit();
}


/* =========================================
   LOGOUT USER
   ========================================= */

function logoutUser()
{
    $_SESSION = [];

    if (ini_get("session.use_cookies")) {

        $params = session_get_cookie_params();

        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    session_destroy();
}


/* =========================================
   SAVE QUIZ SCORE
   ========================================= */

function saveQuizScore($conn, $userId, $score, $totalQuestions)
{
    $stmt = $conn->prepare(
        "INSERT INTO quiz_scores 
        (user_id, score, total_questions, created_at)
        VALUES (?, ?, ?, NOW())"
    );

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param(
        "iii",
        $userId,
        $score,
        $totalQuestions
    );

    $result = $stmt->execute();

    $stmt->close();

    return $result;
}


/* =========================================
   GET USER TOTAL QUIZ ATTEMPTS
   ========================================= */

function getQuizAttempts($conn, $userId)
{
    $stmt = $conn->prepare(
        "SELECT COUNT(*) AS total
         FROM quiz_scores
         WHERE user_id = ?"
    );

    if (!$stmt) {
        return 0;
    }

    $stmt->bind_param("i", $userId);

    $stmt->execute();

    $result = $stmt->get_result();

    $row = $result->fetch_assoc();

    $stmt->close();

    return $row['total'] ?? 0;
}


/* =========================================
   GET USER BEST SCORE
   ========================================= */

function getBestScore($conn, $userId)
{
    $stmt = $conn->prepare(
        "SELECT MAX(score) AS best_score
         FROM quiz_scores
         WHERE user_id = ?"
    );

    if (!$stmt) {
        return 0;
    }

    $stmt->bind_param("i", $userId);

    $stmt->execute();

    $result = $stmt->get_result();

    $row = $result->fetch_assoc();

    $stmt->close();

    return $row['best_score'] ?? 0;
}


/* =========================================
   GET USER AVERAGE SCORE
   ========================================= */

function getAverageScore($conn, $userId)
{
    $stmt = $conn->prepare(
        "SELECT AVG(score) AS average_score
         FROM quiz_scores
         WHERE user_id = ?"
    );

    if (!$stmt) {
        return 0;
    }

    $stmt->bind_param("i", $userId);

    $stmt->execute();

    $result = $stmt->get_result();

    $row = $result->fetch_assoc();

    $stmt->close();

    return round(
        $row['average_score'] ?? 0,
        2
    );
}


/* =========================================
   FORMAT DATE
   ========================================= */

function formatDate($date)
{
    return date(
        "d M Y, h:i A",
        strtotime($date)
    );
}

?>