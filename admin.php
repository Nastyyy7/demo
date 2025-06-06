<?php
require 'config.php';
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = trim($_POST['id']);
    $comment = trim($_POST['comment']);
    $status = trim($_POST['status']);
    $conn ->query("UPDATE `cards` SET `comment` = '$comment', `status` = '$status' WHERE `cards`.`id` = $id;");
}
$cards = $conn->query("SELECT * FROM `cards`")


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Админ-панель</title>
</head>

<body>
    <h1>Добро пожаловать <?php echo $_SESSION['login'] ?></h1>
    <a href="./logout.php">Выйти</a>
    <table>
        <tr>
            <th>Пользователь</th>
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
                <td><?php echo $card['user_id'] ?></td>
                <td><?php echo $card['author'] ?></td>
                <td><?php echo $card['name'] ?></td>
                <td><?php echo $card['send'] ?></td>
                <td><?php echo $card['izdatelstvo'] ?></td>
                <td><?php echo $card['year'] ?></td>
                <td><?php echo $card['pereplet'] ?></td>
                <td><?php echo $card['sostoyanie'] ?></td>
                <td><?php echo $card['comment'] ?></td>
                <td><?php echo $card['status'] ?></td>
                <td>
                    <form method="post">
                        <input name="id" type="hidden" value="<?php echo $card['id'] ?>">
                        <label>Коментарий<input name="comment" type="text">
                        <label>Статус<select name="status">
                            <option value="Опубликовано" <?php  ($card['status']) === 'Опубликовано'?>>Опубликовано</option>
                            <option value="Отклонена" <?php  ($card['status']) === 'Отклонена'?>>Отклонена</option>
                        </select>
                        </label>
                        <input type="submit" value="Сохранить">
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>

    </table>
</body>

</html>