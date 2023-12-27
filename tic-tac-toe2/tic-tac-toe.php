<?php

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "tic-tac-toe";

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$winner = 'n';
$box = array ('', '', '', '', '', '', '', '', '');
if (isset($_POST ['submitbtn'])) {
    $box[0] = $_POST['box0'];
    $box[1] = $_POST['box1'];
    $box[2] = $_POST['box2'];
    $box[3] = $_POST['box3'];
    $box[4] = $_POST['box4'];
    $box[5] = $_POST['box5'];
    $box[6] = $_POST['box6'];
    $box[7] = $_POST['box7'];
    $box[8] = $_POST['box8'];

    if (($box[0]=='x' && $box[1]=='x' && $box[2]=='x') ||
    ($box[3]=='x' && $box[4]=='x' && $box[5]=='x') ||
    ($box[6]=='x' && $box[7]=='x' && $box[8]=='x') ||
    ($box[0]=='x' && $box[3]=='x' && $box[6]=='x') ||
    ($box[2]=='x' && $box[6]=='x' && $box[8]=='x') ||
    ($box[2]=='x' && $box[4]=='x' && $box[6]=='x') ||
    ($box[1]=='x' && $box[4]=='x' && $box[7]=='x') ||
    ($box[2]=='x' && $box[5]=='x' && $box[8]=='x') ||
    ($box[0]=='x' && $box[4]=='x' && $box[8]=='x')) {
        $winner = 'x';
        $insertQuery = "INSERT INTO game_history (winner, game_date) VALUES ('x', NOW())";
        $conn->query($insertQuery);
        print ("<br><br><strong>ПОБЕДА ИГРОКА X.<strong><br>");
    }
    $blank = 0;
    for ($i = 0; $i<=8; $i++) {
        if ($box[$i] == '') {
            $blank = 1;
        }
    }
    if ($blank == 1 && $winner == 'n') {
        $i = rand() % 8;
        while ($box[$i] != '') {
            $i = rand() % 8;
        }
        $box[$i] = 'O';
        if (($box[0]=='O' && $box[1]=='O' && $box[2]=='O') ||
        ($box[3]=='O' && $box[4]=='O' && $box[5]=='O') ||
        ($box[6]=='O' && $box[7]=='O' && $box[8]=='O') ||
        ($box[0]=='O' && $box[3]=='O' && $box[6]=='O') ||
        ($box[2]=='O' && $box[6]=='O' && $box[8]=='O') ||
        ($box[2]=='O' && $box[4]=='O' && $box[6]=='O') ||
        ($box[1]=='O' && $box[4]=='O' && $box[7]=='O') ||
        ($box[2]=='O' && $box[5]=='O' && $box[8]=='O') ||
        ($box[0]=='O' && $box[4]=='O' && $box[8]=='O')) {
            $winner = 'O';
            $insertQuery = "INSERT INTO game_history (winner, game_date) VALUES ('O', NOW())";
            $conn->query($insertQuery);
            print ("<br><br><strong>ПОБЕДА ИГРОКА O.<strong><br>");
    }
} else if ($winner == 'n') {
    $winner = 't';
    $insertQuery = "INSERT INTO game_history (winner, game_date) VALUES ('НИЧЬЯ', NOW())";
    $conn->query($insertQuery);
    print("<br>НИЧЬЯ.");
}
}
?>

<html>
    <head>
        <title>КРЕСТИКИ НОЛИКИ ИГРУШКА</title>
        <style type = "text/css">
            #box {
                background-color: white;
                border: 3px solid black;
                width: 150px;
                height: 150px;
                font-size: 80px;
                text-align: center;
            }

            #go {
                width: 150px;
                height: 50px;
                background-color: #267bb5;
                color: #fff;
                font-size: 20px;
            }

            #again {
                width: 200px;
                height: 50px;
                background-color: #267bb5;
                color: #fff;
                font-size: 20px;
            }

        </style>
    </head>
    <body bgcolor = "#f4f4f4" align = "center">
        <form name "tictactoe" action = "tic-tac-toe.php" method="post">
        <?php
        for ($i=0; $i<=8; $i++) {
            printf ('<input type = "text" name = "box%s" value = "%s" id = "box">', $i, $box[$i]);
            if ($i==2 || $i==5 || $i == 8) {
                print('<br>');
            }
        }
        if ($winner == 'n') {
            print ('</br><input type = "submit" name = "submitbtn" value = "ИГРАТЬ" id = "go">');
        }
        else {
            print ('</br><input type = "button" name = "newgamebtn" value = "ИГРАТЬ ЗАНОВО" id = "again" onclick="window.location.href=\'tic-tac-toe.php\'">');
        }
        ?>
        </form>
        <h3 align=center>Если вы хотите хотите зайти в админ-панель, перейдите <a href="login.php">сюда.</h3>    </body>
</html>
