-- =========================================
-- QUIZ TRIVIA WEB APPLICATION
-- Database: quiz_trivia
-- =========================================

CREATE DATABASE IF NOT EXISTS quiz_trivia;

USE quiz_trivia;


-- =========================================
-- USERS TABLE
-- =========================================

CREATE TABLE IF NOT EXISTS users (

    id INT AUTO_INCREMENT PRIMARY KEY,

    username VARCHAR(100) NOT NULL,

    email VARCHAR(150) NOT NULL UNIQUE,

    password VARCHAR(255) NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);


-- =========================================
-- QUIZ SCORES TABLE
-- =========================================

CREATE TABLE IF NOT EXISTS quiz_scores (

    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT NOT NULL,

    score INT NOT NULL,

    total_questions INT NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE

);


-- =========================================
-- MESSAGES TABLE
-- =========================================

CREATE TABLE IF NOT EXISTS messages (

    id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(100) NOT NULL,

    email VARCHAR(150) NOT NULL,

    message TEXT NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);