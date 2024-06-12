<?php
session_start();
require_once ("gameLogic.php");
require_once ("fileHandler.php");

try {
    $wordsToPlay = fileHandler("data/data.csv");
}
catch (Exception $e) {
    echo ($e->getMessage());
}

if (!isset($_SESSION['chosenWord'])) { //if chosen word isnt null
    $_SESSION['chosenWord'] = chooseWordToGuess($wordsToPlay);
    $_SESSION['unknownLetters'] = array_fill(0, count($_SESSION['chosenWord']), "__");
    $_SESSION['tries'] = 0;
    $_SESSION['triedLetters'] = [];
}

if (isset($_POST["startGame"])) { //if startgame button is clicked
    $_SESSION['chosenWord'] = chooseWordToGuess($wordsToPlay);
    $_SESSION['unknownLetters'] = array_fill(0, count($_SESSION['chosenWord']), "__");
    $_SESSION['tries'] = 0;
    $_SESSION['triedLetters'] = [];
}

if (isset($_POST["letter"])) {
    $guessedLetter = $_POST["letter"];
} else {
    $guessedLetter = '';
}
$_SESSION['triedLetters'][] = strtolower($guessedLetter);



if ($guessedLetter) {
    $letterFound = false; //variable for checking if the letter is in the word
    $maxAvailableTries = 7;

    /*
    //While for displaying the chosen word
    for ($j = 0; $j < count($_SESSION['chosenWord']); $j++) {
        $words = $_SESSION['chosenWord'];
        echo ($words[$j]);
    }
    */

    if (is_numeric(strtolower($_POST["letter"]))){ //check if input is a number
        $letterFound = false;
        echo '
            <div class="container mt-3">
                <div class="alert alert-warning text-center" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> 
                    <b>Warnung: Ein Wort enthält keine Zahlen!</b>
                </div>
            </div>';
    }

    for ($i = 0; $i < count($_SESSION['chosenWord']); $i++) {               //checking if letter is in word
        if (strtolower($_POST["letter"]) == strtolower($_SESSION['chosenWord'][$i])) {
            $_SESSION['unknownLetters'][$i] = $_SESSION['chosenWord'][$i];
            $letterFound = true;
            echo '
                <div class="container mt-3">
                    <div class="alert alert-success text-center" role="alert">
                        <i class="fas fa-check-circle"></i> <b>Letter was correct!</b>
                    </div>
                </div>';
        }
    }

    if (!$letterFound && $_SESSION['tries'] < $maxAvailableTries) { //Guess was wrong and there are still tries left
        $_SESSION['tries']++;

        echo '
            <div class="container mt-5">
                <div class="alert alert-danger text-center" role="alert">
                    <i class="fas fa-times-circle"></i> <b>Letter was incorrect! ' . ($maxAvailableTries - $_SESSION['tries']) . ' tries left</b>
                </div>
            </div>';
    }  
    elseif ($_SESSION['tries'] < $maxAvailableTries && checkIfAlreadyTried($_SESSION['triedLetters'], strtolower($guessedLetter)) > 2) {
      $_SESSION['tries']++;
        echo '
            <div class="container mt-3">
                <div class="alert alert-warning text-center" role="alert">
                    <i class="fas fa-exclamation-circle"></i> <b>Letter was already tried! ' . ($maxAvailableTries - $_SESSION['tries']) . ' tries left</b>
                </div>
            </div>';
    }
    elseif ($_SESSION['tries'] >= $maxAvailableTries) { //if too much tries
        echo '
            <div class="container mt-3">
                <div class="alert alert-danger text-center" role="alert">
                    <i class="fas fa-skull-crossbones"></i> <b>You lost!</b>
                </div>
            </div>';
      gameEnd();
    }

    $checkIfWon = 0;

    for ($i = 0; $i < count($_SESSION['unknownLetters']); $i++) {
      if($_SESSION['unknownLetters'][$i] != "__") {
        $checkIfWon++;
      }
    }
    if($checkIfWon == count($_SESSION['unknownLetters'])) {
        echo '
            <div class="container mt-3">
                <div class="alert alert-success text-center" role="alert">
                    <i class="fas fa-trophy"></i> <b>You won!</b>
                </div>
            </div>';
      gameEnd();
    }
}

require_once("view.php");
?>
