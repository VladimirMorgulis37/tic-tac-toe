<?php

require_once 'models/GameHistoryModel.php';
require_once 'controllers/GameHistoryController.php';
require_once 'views/GameHistoryView.php';

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "tic-tac-toe";

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
// Проверка, авторизован ли пользователь
if (!isset($_SESSION["username"])) {
    // Если не авторизован, перенаправление на страницу входа
    header("Location: login.php");
    exit();
}
// Создаем экземпляры модели, контроллера и представления для истории игр
$historyModel = new GameHistoryModel($conn);
$historyView = new GameHistoryView($conn);
$historyController = new GameHistoryController($historyModel, $historyView);

$historyController->handleDelete();
$historyController->displayHistory();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Таблица историй игр</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2 align=center>Привет, <?php echo $_SESSION["username"]; ?>!</h2>
    <h3 align=center>Если вы хотите вернуться к игре, перейдите <a href="tic-tac-toe.php">сюда.</h3>
</body>
</html>
