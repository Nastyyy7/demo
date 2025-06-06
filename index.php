<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fio = trim($_POST['fio']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);

    if (!preg_match('/^[а-яёА-ЯЁ\s]+$/', $fio)) {
        echo 'Используйье только кириллицу';
    }
    if (strlen($login) < 6) {
        echo 'Логин должен содержать больше 6 символов';
    }
    if (strlen($password) < 6) {
        echo 'Пароль должен содержать больше 6 символов';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Введите верный формат email';
    }
    $check = $conn->query('SELECT * FROM `users` WHERE login = "$login"');
    if ($check->num_rows > 0) {
        echo 'Введите уникальный логин';
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $conn->query("INSERT INTO `users` (`fio`, `phone`, `email`, `login`, `password`) VALUES ('$fio', '$phone', '$email', '$login', '$hash');");
        header('Location:login.php');
        exit;
    }
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
    <h1>Регистраиция</h1>
    <form method="post">
        <label>ФИО<input name="fio" type="text" placeholder="ФИО"></label>
        <label>Телефон<input name="phone" type="text" placeholder="+7(XXX)-XXX-XX-XX"></label>
        <label>Почта<input name="email" type="text" placeholder="example@example.com"></label>
        <label>Логин<input name="login" type="text" placeholder="Логин"></label>
        <label>Пароль<input name="password" type="text" placeholder="Пароль"></label>
        <input type="submit" value="Зарегистрироваться">
        <a href="./login.php">Авторизоваться</a>
    </form>
</body>

</html>