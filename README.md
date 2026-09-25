# Quiz Trivia Web Application

## Project Description

Quiz Trivia Web Application is an interactive web-based quiz system developed as an ICT 2209 – Web Technologies mini project.

The main purpose of this project is to provide users with a simple and interactive platform where they can register, log in, participate in a web technology quiz, view their quiz results, and send messages through the contact form.

The application was developed using HTML, CSS, Bootstrap, JavaScript, PHP and MySQL. XAMPP was used as the local development environment.

---

## Project Objectives

The main objectives of this project are:

- To create a responsive and user-friendly quiz web application.
- To provide user registration and login functionality.
- To allow registered users to participate in quizzes.
- To validate user input using JavaScript and PHP.
- To store user information in a MySQL database.
- To store quiz scores and quiz attempts.
- To provide a contact form connected to the database.
- To demonstrate frontend and backend web development.
- To create a proper project structure for easy maintenance.

---

## Technologies Used

### Frontend

- HTML5
- CSS3
- Bootstrap
- JavaScript

### Backend

- PHP

### Database

- MySQL

### Development Environment

- XAMPP
- Apache
- MySQL
- phpMyAdmin
- Visual Studio Code

### Version Control

- Git
- GitHub

---

## Main Features

### 1. Home Page

The home page introduces the Quiz Trivia Web Application and provides navigation to the main sections of the website.

### 2. User Registration

New users can create an account by providing:

- Username
- Email
- Password
- Confirm Password

Passwords are securely stored using PHP password hashing.

### 3. User Login

Registered users can log in using their email and password.

PHP session management is used to maintain the user's login session.

### 4. Quiz System

The quiz contains questions related to web technologies such as:

- HTML
- CSS
- JavaScript
- PHP
- MySQL

The quiz includes:

- Multiple-choice questions
- Timer
- Progress bar
- Previous button
- Next button
- Final score display

### 5. Dashboard

The dashboard is available for logged-in users.

It provides information such as:

- Total quiz attempts
- Best score
- Average score
- Quiz history

### 6. Contact Form

Users can send messages through the contact page.

The submitted:

- Name
- Email
- Message
- Date and time

are stored in the MySQL database.

### 7. Responsive Design

The website is designed to work on:

- Desktop computers
- Laptops
- Tablets
- Mobile phones

---

# Project Folder Structure

```text
quiz-trivia/
│
├── auth/
│   ├── register.php
│   ├── login.php
│   └── logout.php
│
├── css/
│   └── style.css
│
├── images/
│   ├── index.php
│
├── includes/
│   ├── db.php
│   └── functions.php
│
├── js/
│   └── script.js
│
├── index.php
├── quiz.php
├── features.php
├── dashboard.php
├── contact.php
├── database.sql
└── README.md