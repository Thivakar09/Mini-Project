/* =========================================================
   QUIZ TRIVIA WEB APPLICATION
   script.js
   Quiz Duration: 3 Minutes (180 Seconds)
   ========================================================= */


/* =========================================================
   QUIZ QUESTIONS
   ========================================================= */

const quizQuestions = [

    {
        question: "What does HTML stand for?",
        options: [
            "Hyper Text Markup Language",
            "High Text Machine Language",
            "Hyperlink Text Management Language",
            "Home Tool Markup Language"
        ],
        answer: 0
    },

    {
        question: "Which language is used to style web pages?",
        options: [
            "HTML",
            "CSS",
            "PHP",
            "SQL"
        ],
        answer: 1
    },

    {
        question: "Which language is used to make web pages interactive?",
        options: [
            "HTML",
            "CSS",
            "JavaScript",
            "MySQL"
        ],
        answer: 2
    },

    {
        question: "Which HTML tag is used to create a hyperlink?",
        options: [
            "<link>",
            "<a>",
            "<href>",
            "<url>"
        ],
        answer: 1
    },

    {
        question: "Which CSS property changes the text colour?",
        options: [
            "font-style",
            "text-color",
            "color",
            "background"
        ],
        answer: 2
    },

    {
        question: "Which symbol is used for an ID selector in CSS?",
        options: [
            ".",
            "#",
            "*",
            "@"
        ],
        answer: 1
    },

    {
        question: "Which HTML tag is used to display an image?",
        options: [
            "<image>",
            "<picture>",
            "<img>",
            "<src>"
        ],
        answer: 2
    },

    {
        question: "Which method is used to display output in the browser console?",
        options: [
            "console.log()",
            "print()",
            "display()",
            "write()"
        ],
        answer: 0
    },

    {
        question: "Which database is used in this project?",
        options: [
            "MongoDB",
            "MySQL",
            "Oracle",
            "SQLite"
        ],
        answer: 1
    },

    {
        question: "Which PHP function is used to securely hash a password?",
        options: [
            "password_hash()",
            "hash_password()",
            "secure_password()",
            "encrypt_password()"
        ],
        answer: 0
    }

];


/* =========================================================
   QUIZ VARIABLES
   ========================================================= */

let currentQuestion = 0;

let score = 0;

let selectedAnswer = null;


/*
   180 Seconds = 3 Minutes
*/
let timeLeft = 180;

let timerInterval = null;


/* =========================================================
   HELPER FUNCTION
   ========================================================= */

function getElement(id) {

    return document.getElementById(id);

}


/* =========================================================
   START QUIZ
   ========================================================= */

function startQuiz() {

    currentQuestion = 0;

    score = 0;

    selectedAnswer = null;

    /*
       Reset timer to 3 minutes
    */
    timeLeft = 180;

    clearInterval(timerInterval);


    const resultBox =
        getElement("result-box");


    if (resultBox) {

        resultBox.style.display = "none";

    }


    const questionBox =
        document.querySelector(".question");


    if (questionBox) {

        questionBox.style.display = "block";

    }


    const optionsContainer =
        getElement("options-container");


    if (optionsContainer) {

        optionsContainer.style.display = "block";

    }


    const quizButtons =
        document.querySelector(".quiz-buttons");


    if (quizButtons) {

        quizButtons.style.display = "flex";

    }


    const totalQuestions =
        getElement("total-questions");


    if (totalQuestions) {

        totalQuestions.textContent =
            quizQuestions.length;

    }


    showQuestion();

    startTimer();

}


/* =========================================================
   SHOW QUESTION
   ========================================================= */

function showQuestion() {

    const question =
        quizQuestions[currentQuestion];


    if (!question) {

        console.error(
            "Quiz question not found."
        );

        return;

    }


    /* -----------------------------------------
       Question Number
       ----------------------------------------- */

    const currentQuestionElement =
        getElement("current-question");


    if (currentQuestionElement) {

        currentQuestionElement.textContent =
            currentQuestion + 1;

    }


    /* -----------------------------------------
       Question Text
       ----------------------------------------- */

    const questionText =
        getElement("question-text");


    if (questionText) {

        questionText.textContent =
            question.question;

    } else {

        console.error(
            "Element #question-text was not found."
        );

    }


    /* -----------------------------------------
       Options
       ----------------------------------------- */

    const optionsContainer =
        getElement("options-container");


    if (!optionsContainer) {

        console.error(
            "Element #options-container was not found."
        );

        return;

    }


    optionsContainer.innerHTML = "";


    question.options.forEach(
        function(option, index) {

            const optionElement =
                document.createElement("button");


            optionElement.type =
                "button";


            optionElement.className =
                "option";


            optionElement.textContent =
                option;


            optionElement.addEventListener(
                "click",
                function() {

                    selectAnswer(
                        index,
                        optionElement
                    );

                }
            );


            optionsContainer.appendChild(
                optionElement
            );

        }
    );


    /* -----------------------------------------
       Progress Bar
       ----------------------------------------- */

    const progressBar =
        getElement("progress-bar");


    if (progressBar) {

        const progress =
            (
                (currentQuestion + 1) /
                quizQuestions.length
            ) * 100;


        progressBar.style.width =
            progress + "%";

    }


    /* -----------------------------------------
       Previous Button
       ----------------------------------------- */

    const previousButton =
        getElement("previous-btn");


    if (previousButton) {

        if (currentQuestion === 0) {

            previousButton.style.display =
                "none";

        } else {

            previousButton.style.display =
                "inline-block";

        }

    }


    /* -----------------------------------------
       Next Button
       ----------------------------------------- */

    const nextButton =
        getElement("next-btn");


    if (nextButton) {

        if (
            currentQuestion ===
            quizQuestions.length - 1
        ) {

            nextButton.textContent =
                "Finish Quiz";

        } else {

            nextButton.textContent =
                "Next";

        }

    }


    selectedAnswer = null;

}


/* =========================================================
   SELECT ANSWER
   ========================================================= */

function selectAnswer(
    answerIndex,
    selectedElement
) {

    selectedAnswer =
        answerIndex;


    const options =
        document.querySelectorAll(".option");


    options.forEach(
        function(option) {

            option.classList.remove(
                "selected"
            );

        }
    );


    selectedElement.classList.add(
        "selected"
    );

}


/* =========================================================
   NEXT QUESTION
   ========================================================= */

function nextQuestion() {

    if (selectedAnswer === null) {

        alert(
            "Please select an answer."
        );

        return;

    }


    const correctAnswer =
        quizQuestions[currentQuestion].answer;


    if (
        selectedAnswer ===
        correctAnswer
    ) {

        score++;

    }


    if (
        currentQuestion <
        quizQuestions.length - 1
    ) {

        currentQuestion++;

        showQuestion();

    } else {

        showResult();

    }

}


/* =========================================================
   PREVIOUS QUESTION
   ========================================================= */

function previousQuestion() {

    if (currentQuestion > 0) {

        currentQuestion--;

        showQuestion();

    }

}


/* =========================================================
   TIMER - 3 MINUTES
   ========================================================= */

function startTimer() {

    clearInterval(timerInterval);


    /*
       3 Minutes = 180 Seconds
    */
    timeLeft = 180;


    const timer =
        getElement("timer");


    if (!timer) {

        console.error(
            "Element #timer was not found."
        );

        return;

    }


    /* -----------------------------------------
       Display initial time
       ----------------------------------------- */

    updateTimerDisplay(timer);


    /* -----------------------------------------
       Start countdown
       ----------------------------------------- */

    timerInterval =
        setInterval(
            function() {

                timeLeft--;


                updateTimerDisplay(timer);


                /*
                   Time finished
                */

                if (timeLeft <= 0) {

                    clearInterval(
                        timerInterval
                    );


                    alert(
                        "Time is up!"
                    );


                    showResult();

                }

            },
            1000
        );

}


/* =========================================================
   TIMER DISPLAY
   ========================================================= */

function updateTimerDisplay(timer) {

    const minutes =
        Math.floor(
            timeLeft / 60
        );


    const seconds =
        timeLeft % 60;


    const formattedSeconds =
        seconds < 10
            ? "0" + seconds
            : seconds;


    /*
       Example:
       3:00
       2:59
       2:58
       ...
       0:01
       0:00
    */

    timer.textContent =
        minutes +
        ":" +
        formattedSeconds;

}


/* =========================================================
   SHOW RESULT
   ========================================================= */

function showResult() {

    clearInterval(
        timerInterval
    );


    const questionBox =
        document.querySelector(".question");


    if (questionBox) {

        questionBox.style.display =
            "none";

    }


    const optionsContainer =
        getElement("options-container");


    if (optionsContainer) {

        optionsContainer.style.display =
            "none";

    }


    const quizButtons =
        document.querySelector(".quiz-buttons");


    if (quizButtons) {

        quizButtons.style.display =
            "none";

    }


    const resultBox =
        getElement("result-box");


    if (resultBox) {

        resultBox.style.display =
            "block";

    }


    const finalScore =
        getElement("final-score");


    if (finalScore) {

        finalScore.textContent =
            score +
            " / " +
            quizQuestions.length;

    }


    const scoreMessage =
        getElement("score-message");


    if (scoreMessage) {

        const percentage =
            (
                score /
                quizQuestions.length
            ) * 100;


        if (percentage >= 80) {

            scoreMessage.textContent =
                "Excellent! Great work!";

        }

        else if (percentage >= 60) {

            scoreMessage.textContent =
                "Good job! Keep practising.";

        }

        else {

            scoreMessage.textContent =
                "Keep practising and try again!";

        }

    }


    saveScore(score);

}


/* =========================================================
   RESTART QUIZ
   ========================================================= */

function restartQuiz() {

    clearInterval(
        timerInterval
    );


    currentQuestion = 0;

    score = 0;

    selectedAnswer = null;

    timeLeft = 180;


    const questionBox =
        document.querySelector(".question");


    if (questionBox) {

        questionBox.style.display =
            "block";

    }


    const optionsContainer =
        getElement("options-container");


    if (optionsContainer) {

        optionsContainer.style.display =
            "block";

    }


    const quizButtons =
        document.querySelector(".quiz-buttons");


    if (quizButtons) {

        quizButtons.style.display =
            "flex";

    }


    const resultBox =
        getElement("result-box");


    if (resultBox) {

        resultBox.style.display =
            "none";

    }


    showQuestion();

    startTimer();

}


/* =========================================================
   SAVE SCORE
   ========================================================= */

function saveScore(scoreValue) {

    localStorage.setItem(
        "quizScore",
        scoreValue
    );

}


/* =========================================================
   GET SAVED SCORE
   ========================================================= */

function getSavedScore() {

    return localStorage.getItem(
        "quizScore"
    );

}


/* =========================================================
   DISPLAY SAVED SCORE
   ========================================================= */

function displaySavedScore(
    elementId
) {

    const element =
        getElement(elementId);


    if (!element) {

        return;

    }


    const savedScore =
        getSavedScore();


    if (savedScore !== null) {

        element.textContent =
            savedScore;

    }

}


/* =========================================================
   FORM VALIDATION
   ========================================================= */

function validateForm(form) {

    const requiredFields =
        form.querySelectorAll(
            "[required]"
        );


    for (
        let i = 0;
        i < requiredFields.length;
        i++
    ) {

        if (
            requiredFields[i]
                .value
                .trim() === ""
        ) {

            alert(
                "Please fill in all required fields."
            );


            requiredFields[i].focus();


            return false;

        }

    }


    return true;

}


/* =========================================================
   PASSWORD VALIDATION
   ========================================================= */

function validatePassword() {

    const password =
        getElement("password");


    const confirmPassword =
        getElement("confirm_password");


    if (
        password &&
        confirmPassword
    ) {

        if (
            password.value !==
            confirmPassword.value
        ) {

            alert(
                "Passwords do not match."
            );


            confirmPassword.focus();


            return false;

        }

    }


    return true;

}


/* =========================================================
   LOGOUT CONFIRMATION
   ========================================================= */

function confirmLogout() {

    return confirm(
        "Are you sure you want to logout?"
    );

}


/* =========================================================
   CONTACT FORM VALIDATION
   ========================================================= */

function validateContactForm(form) {

    const name =
        getElement("name");


    const email =
        getElement("email");


    const message =
        getElement("message");


    if (
        !name ||
        !email ||
        !message
    ) {

        return true;

    }


    if (
        name.value.trim() === ""
    ) {

        alert(
            "Please enter your name."
        );


        name.focus();


        return false;

    }


    if (
        email.value.trim() === ""
    ) {

        alert(
            "Please enter your email."
        );


        email.focus();


        return false;

    }


    if (
        message.value.trim() === ""
    ) {

        alert(
            "Please enter your message."
        );


        message.focus();


        return false;

    }


    return true;

}


/* =========================================================
   SMOOTH SCROLL
   ========================================================= */

function enableSmoothScroll() {

    const links =
        document.querySelectorAll(
            'a[href^="#"]'
        );


    links.forEach(
        function(link) {

            link.addEventListener(
                "click",
                function(event) {

                    const target =
                        document.querySelector(
                            this.getAttribute("href")
                        );


                    if (target) {

                        event.preventDefault();


                        target.scrollIntoView({
                            behavior: "smooth"
                        });

                    }

                }
            );

        }
    );

}


/* =========================================================
   TOGGLE CONTENT
   ========================================================= */

function toggleContent(
    elementId
) {

    const element =
        getElement(elementId);


    if (!element) {

        return;

    }


    if (
        element.style.display ===
        "none"
    ) {

        element.style.display =
            "block";

    }

    else {

        element.style.display =
            "none";

    }

}


/* =========================================================
   FILTER ITEMS
   ========================================================= */

function filterItems(
    searchInput,
    itemSelector
) {

    const searchText =
        searchInput.value
            .toLowerCase();


    const items =
        document.querySelectorAll(
            itemSelector
        );


    items.forEach(
        function(item) {

            const itemText =
                item.textContent
                    .toLowerCase();


            if (
                itemText.includes(
                    searchText
                )
            ) {

                item.style.display =
                    "";

            }

            else {

                item.style.display =
                    "none";

            }

        }
    );

}


/* =========================================================
   PAGE INITIALIZATION
   ========================================================= */

document.addEventListener(
    "DOMContentLoaded",
    function() {

        enableSmoothScroll();


        /*
           Automatically start quiz
           when quiz page contains
           question-text and options-container.
        */

        const questionText =
            getElement(
                "question-text"
            );


        const optionsContainer =
            getElement(
                "options-container"
            );


        if (
            questionText &&
            optionsContainer
        ) {

            startQuiz();

        }

    }
);
