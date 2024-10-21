<p><a href="index.php">Lab5</a></p>
<p><a href="z09-1.php">Lab7 Создание бд</a></p>
<p><a href="z09-2.php">Lab7 Заполнение бд</a></p>
<p><a href="z09-3.php">Lab7 Вывод бд</a></p>
<p><a href="z09-4.php">Lab7 Редактирование бд</a></p>
<?php
$mysqli = new mysqli('mysql', 'root', 'example_password', 'sample', 3306);

if ($mysqli->connect_errno) {
    die("Connect Error: " . $mysqli->connect_error);
}

// Удаляем таблицу, если она уже существует
$dropTableSQL = "DROP TABLE IF EXISTS notebook_br04";
if (!$mysqli->query($dropTableSQL)) {
    die("Ошибка при удалении таблицы: " . $mysqli->error);
}

// Создаем новую таблицу notebook_br04
$createTableSQL = "
CREATE TABLE notebook_br04 (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    city VARCHAR(50),
    address VARCHAR(50),
    birthday DATE,
    mail VARCHAR(20)
)";

if ($mysqli->query($createTableSQL) === TRUE) {
    echo "Таблица notebook_br04 успешно создана.";
} else {
    echo "Нельзя создать таблицу notebook_br04: " . $mysqli->error;
}

$mysqli->close();
?>