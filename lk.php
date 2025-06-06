<?php
require 'config.php';
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
}

$cards = $conn->query("SELECT * FROM `cards` WHERE user_id= {$_SESSION['id']} AND status='Опубликовано';");
$nocards = $conn->query("SELECT * FROM `cards` WHERE user_id= {$_SESSION['id']} AND (status='Отклонена' OR status='На рассмотрении');")

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Мои карточки</title>
</head>

<body>
    <h1>Добро пожаловать <?php echo $_SESSION['login'] ?></h1>
    <a href="./add_card.php">Добавить карточку</a>
    <a href="./logout.php">Выйти</a>
    <h2>Опубликованные карточки</h2>
    <table>
        <tr>
            <th>Автор</th>
            <th>Название книги</th>
            <th>Готов поделиться/Хочу в свою библиотеку</th>
            <th>Издательство</th>
            <th>Год издания</th>
            <th>Переплет</th>
            <th>Состояние книги</th>
            <th>Коментарий</th>
            <th>Статус</th>
        </tr>
        <?php while ($card = $cards->fetch_assoc()): ?>
            <tr>
                <td><?php echo $card['author'] ?></td>
                <td><?php echo $card['name'] ?></td>
                <td><?php echo $card['send'] ?></td>
                <td><?php echo $card['izdatelstvo'] ?></td>
                <td><?php echo $card['year'] ?></td>
                <td><?php echo $card['pereplet'] ?></td>
                <td><?php echo $card['sostoyanie'] ?></td>
                <td><?php echo $card['comment'] ?></td>
                <td><?php echo $card['status'] ?></td>

            </tr>
        <?php endwhile; ?>

    </table>
    <h2>Отклонённые карточки</h2>

    <table>
        <tr>
            <th>Автор</th>
            <th>Название книги</th>
            <th>Готов поделиться/Хочу в свою библиотеку</th>
            <th>Издательство</th>
            <th>Год издания</th>
            <th>Переплет</th>
            <th>Состояние книги</th>
            <th>Коментарий</th>
            <th>Статус</th>
        </tr>
        <?php while ($card = $nocards->fetch_assoc()): ?>
            <tr>
                <td><?php echo $card['author'] ?></td>
                <td><?php echo $card['name'] ?></td>
                <td><?php echo $card['send'] ?></td>
                <td><?php echo $card['izdatelstvo'] ?></td>
                <td><?php echo $card['year'] ?></td>
                <td><?php echo $card['pereplet'] ?></td>
                <td><?php echo $card['sostoyanie'] ?></td>
                <td><?php echo $card['comment'] ?></td>
                <td><?php echo $card['status'] ?></td>

            </tr>
        <?php endwhile; ?>

    </table>
</body>

</html>