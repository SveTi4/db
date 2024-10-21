<!DOCTYPE html>
<html>
<head>
    <title>Lab3 Редактирование бд</title>
</head>
<body>
    <h1>Lab3 Редактирование бд</h1>
    <p><a href="index.php">Lab1</a></p>
    <p><a href="z09-1.php">Lab7 Создание бд</a></p>
    <p><a href="z09-2.php">Lab7 Заполнение бд</a></p>
    <p><a href="z09-3.php">Lab7 Вывод бд</a></p>
    <p><a href="z09-4.php">Lab7 Редактирование бд</a></p>
    <?php
    $mysqli = new mysqli('mysql', 'root', 'example_password', 'sample', 3306);

    if ($mysqli->connect_errno) {
        die("Connect Error: " . $mysqli->connect_error);
    }

    // Проверяем наличие значений переменных id, field_name и field_value
    $id = $_POST['id'] ?? null;
    $field_name = $_POST['field_name'] ?? null;
    $field_value = $_POST['field_value'] ?? null;

    // Если $id и $field_name заданы, выполняем обновление записи
    if ($id && $field_name && $field_value) {
        // Валидация данных
        $is_valid = true;
        if ($field_name === 'mail' && !filter_var($field_value, FILTER_VALIDATE_EMAIL)) {
            echo "Некорректный email.";
            $is_valid = false;
        } elseif ($field_name === 'birthday' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $field_value)) {
            echo "Некорректный формат даты. Используйте YYYY-MM-DD.";
            $is_valid = false;
        }

        if ($is_valid) {
            // Обновляем значение поля
            $stmt = $mysqli->prepare("UPDATE notebook_br04 SET $field_name = ? WHERE id = ?");
            $stmt->bind_param("si", $field_value, $id);
            if ($stmt->execute()) {
                echo "Запись успешно обновлена.";
            } else {
                echo "Ошибка при обновлении записи: " . $stmt->error;
            }
            $stmt->close();
        }
    }

    // Получаем все записи из таблицы
    $result = $mysqli->query("SELECT * FROM notebook_br04");

    if ($result->num_rows > 0) {
        echo "<form action='' method='post'>";
        echo "<table border='1'>";
        echo "<tr><th>Select</th><th>ID</th><th>Name</th><th>City</th><th>Address</th><th>Birthday</th><th>Mail</th></tr>";

        // Отображаем строки таблицы с радиокнопками
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><input type='radio' name='id' value='" . htmlspecialchars($row['id']) . "'" . ($id == $row['id'] ? " checked" : "") . "></td>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['city']) . "</td>";
            echo "<td>" . htmlspecialchars($row['address']) . "</td>";
            echo "<td>" . htmlspecialchars($row['birthday']) . "</td>";
            echo "<td>" . htmlspecialchars($row['mail']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<input type='submit' value='Выбрать для редактирования'>";
        echo "</form>";

        // Если $id задан, отображаем форму для редактирования
        if ($id) {
            // Получаем данные выбранной записи
            $record = $mysqli->query("SELECT * FROM notebook_br04 WHERE id = $id")->fetch_assoc();

            echo "<form action='' method='post'>";
            echo "<input type='hidden' name='id' value='" . htmlspecialchars($id) . "'>";
            echo "<label for='field_name'>Field to edit:</label>";
            echo "<select name='field_name'>
                    <option value='name'>Name</option>
                    <option value='city'>City</option>
                    <option value='address'>Address</option>
                    <option value='birthday'>Birthday</option>
                    <option value='mail'>Mail</option>
                  </select>";

            echo "<label for='field_value'>New Value:</label>";
            echo "<input type='text' name='field_value'>";

            echo "<input type='submit' value='Заменить'>";
            echo "</form>";
        }
    } else {
        echo "Записей не найдено.";
    }

    $mysqli->close();
    ?>
</body>
</html>