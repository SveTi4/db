<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Подключаемся к базе данных
    $mysqli = new mysqli('mysql', 'root', 'example_password', 'sample', 3306);

    if ($mysqli->connect_errno) {
        die("Connect Error: " . $mysqli->connect_error);
    }

    // Получаем значения из формы
    $name = $_POST['name'] ?? '';
    $city = $_POST['city'] ?? '';
    $address = $_POST['address'] ?? '';
    $birthday = $_POST['birthday'] ?? '';
    $mail = $_POST['mail'] ?? '';

    // Проверяем, чтобы обязательные поля были заполнены
    if (!empty($name) && !empty($mail)) {
        $stmt = $mysqli->prepare("INSERT INTO notebook_br04 (name, city, address, birthday, mail) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $city, $address, $birthday, $mail);
        if ($stmt->execute()) {
            echo "Данные успешно добавлены в таблицу.";
        } else {
            echo "Ошибка при добавлении данных: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Поля name и mail обязательны для заполнения.";
    }

    $mysqli->close();
}
?>
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
    <form action="" method="post">
        <label for="name">Name (обязательно):</label>
        <input type="text" name="name" required><br>

        <label for="city">City:</label>
        <input type="text" name="city"><br>

        <label for="address">Address:</label>
        <input type="text" name="address"><br>

        <label for="birthday">Birthday (YYYY-MM-DD):</label>
        <input type="text" name="birthday"><br>

        <label for="mail">Mail (обязательно):</label>
        <input type="text" name="mail" required><br>

        <input type="submit" value="Добавить">
    </form>
</body>
</html>