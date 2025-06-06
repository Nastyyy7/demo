<?php
require 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);

    if ($login == 'admin' && $password == 'bookworm') {
        $check = $conn->query("SELECT * FROM `users` WHERE login = 'admin'");
        $admin = $check->fetch_assoc();
        $_SESSION['id'] = $admin['id'];
        $_SESSION['login'] = $admin['login'];
        header('Location: admin.php');
    }

    $check = $conn->query("SELECT * FROM `users` WHERE login = '$login'");
    if ($check->num_rows === 1) {
        $user = $check->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['login'] = $user['login'];
            header('Location: add_card.php');
            exit;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Авторизация</title>
</head>

<body>
    <h1>Авторизация</h1>
    <form method="post">
        <label>Логин<input name="login" type="text" placeholder="Логин"></label>
        <label>Пароль<input name="password" type="text" placeholder="Пароль"></label>
        <input type="submit" value="Войти">
        <a href="./index.php">Регистраиция</a>
    </form>

</body>

</html>