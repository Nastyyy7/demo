<?php
require 'config.php';

session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $autor = trim($_POST['autor']);
    $name = trim($_POST['name']);
    $send = trim($_POST['send']);
    $izdatelstvo = trim($_POST['izdatelstvo']);
    $year = trim($_POST['year']);
    $pereplet = trim($_POST['pereplet']);
    $sostoyanie = trim($_POST['sostoyanie']);

    $conn->query("INSERT INTO `cards` (`user_id`, `author`, `name`, `send`, `izdatelstvo`, `year`, `pereplet`, `sostoyanie`, `comment`, `status`) VALUES ('{$_SESSION['id']}', '$autor', '$name', '$send', '$izdatelstvo', '$year', '$pereplet', '$sostoyanie', '', 'На рассмотрении');");
    header('Location:lk.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Регистраиция</title>
</head>

<body>
    <h1>Создание карточки</h1>
    <a href="./lk.php">Посмотреть карточки</a>
    <form method="post">
        <label>Автор<input name="autor" type="text" required></label>
        <label>Название книги<input name="name" type="text" required></label>
        <label><input name="send" value="Готов поделиться" type="radio"required>Готов поделиться</label>
        <label><input name="send" value="Хочу в свою библиотеку" type="radio" required>Хочу в свою библиотеку</label>
        <br>
        <label>Издательство<input name="izdatelstvo" type="text"></label>
        <label>Год  издания<input name="year" type="number"></label>
        <label>Переплет<input name="pereplet" type="text"></label>
        <label>Состояние книги<input name="sostoyanie" type="text"></label>
        <input type="submit" value="Создать карточку">
    </form>
</body>

</html>