<?php

/* =========================================
   QUIZ TRIVIA WEB APPLICATION
   Database Connection
   ========================================= */


/* Database server */
$host = "localhost";


/* MySQL username */
$username = "root";


/* MySQL password */
/* Default XAMPP password is empty */
$password = "";


/* Database name */
$database = "quiz_trivia";


/* Create database connection */
$conn = new mysqli(
    $host,
    $username,
    $password,
    $database
);


/* Check connection */
if ($conn->connect_error) {

    die(
        "Database connection failed: "
        . $conn->connect_error
    );

}


/* Set character encoding */
$conn->set_charset("utf8mb4");

?>