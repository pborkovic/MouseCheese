<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mouse Cheese</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post" name="form">
        <div class="card">
            <div class="card-header text-center">
                <h1>Mouse Cheese</h1>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="letter">Letter:</label>
                    <input type="text" class="form-control" id="letter" name="letter">
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary" name="guess">Guess</button>
                    <button type="submit" class="btn btn-secondary" name="startGame">New Game</button>
                </div>
                <div id="word" class="text-center mt-4">
                    <?php
                    for ($i = 0; $i < count($_SESSION['chosenWord']); $i++) {
                        echo $_SESSION['unknownLetters'][$i] . " ";
                    }
                    ?>
                </div>
                <div id="triedLetters" class="text-center mt-4">
                    <?php
                    echo "<br> Letters you have already tried: ";
                    foreach ($_SESSION['triedLetters'] as $letter) {
                        echo '<span class="badge badge-primary">' . $letter . '</span>&nbsp;';
                    }
                    ?>
                </div>
                <div id="mouseChecksCheese" class="text-center mt-4">
                    <?php
                    if ($_SESSION['tries'] >= 1 && $_SESSION['tries'] <= 8) {
                        if ($_SESSION['tries'] >= 7){
                            echo ('<img src="img/07.jpeg" class="img-fluid" alt="Mouse close to cheese">');
                        }
                        $imageNumber = str_pad($_SESSION['tries'], 2, '0', STR_PAD_LEFT);
                        echo '<img src="img/' . $imageNumber . '.png" class="img-fluid" alt="Game progress image">';
                    }
                    ?>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
