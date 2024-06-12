<?php
function chooseWordToGuess($wordsArray) { //Function to choose a random word out of the array
    $randomIndexPosition = rand(0, count($wordsArray) - 1);
    return str_split($wordsArray[$randomIndexPosition]);
}

function gameEnd() { //Function to end the game
    unset($_SESSION['chosenWord']);
    unset($_SESSION['unknownLetters']);
    unset($_SESSION['tries']);
    echo '<div class="text-center mt-3"><button class="btn btn-secondary" onclick="window.location.href=\'' . $_SERVER['SCRIPT_NAME'] . '\'">New Game</button></div>';
    exit();
}

function showAllTriedLetters($lettersArray) { //Function to show all the tryed letters
    for($i = 0; $i < count($lettersArray); $i++) {
        echo $lettersArray[$i] . " ";
    }
}

function checkIfAlreadyTried($letterArray, $letter) { //Function to check if the letter has already been tried
    $counter = 0;
    for ($i = 0; $i < count($letterArray); $i++) {
        if (strtolower($letterArray[$i]) == strtolower($letter)) {
            $counter++;
        }
    }
    return $counter;
}


