<!DOCTYPE html>
<html>
<head>
    <title>Lab3 Заполнение бд</title>
</head>
<body>
    <h1>Lab3 Заполнение бд</h1>
    <p><a href="index.php">Lab1</a></p>
    <p><a href="z09-1.php">Lab3 Создание бд</a></p>
    <p><a href="z09-2.php">Lab3 Заполнение бд</a></p>
    <p><a href="z09-3.php">Lab3 Вывод бд</a></p>
    <p><a href="z09-4.php">Lab3 Редактирование бд</a></p>
    <?php
    // Подключаемся к базе данных
    $mysqli = new mysqli('mysql', 'root', 'example_password', 'sample', 3306);

    if ($mysqli->connect_errno) {
        die("Connect Error: " . $mysqli->connect_error);
    }

    // Получаем все записи из таблицы
    $result = $mysqli->query("SELECT * FROM notebook_br04");

    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Name</th><th>City</th><th>Address</th><th>Birthday</th><th>Mail</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['city']) . "</td>";
            echo "<td>" . htmlspecialchars($row['address']) . "</td>";
            echo "<td>" . htmlspecialchars($row['birthday']) . "</td>";
            echo "<td>" . htmlspecialchars($row['mail']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Записей не найдено.";
    }

    $mysqli->close();
    ?>
</body>
</html>