<?php
function vid_structure($table) {
    global $mysqli;

    $result = $mysqli->query("DESCRIBE $table");
    if ($result) {
        echo "<h4>Структура таблицы $table</h4>";
        echo "<table border='1'>";
        echo "<tr><th>Поле</th><th>Тип</th><th>NULL</th><th>Ключ</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['Field']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Type']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Null']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Key']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Ошибка при получении структуры таблицы.";
    }
}

function vid_content($table) {
    global $mysqli;

    $rus_name = [
        'snum' => 'Номер продавца',
        'sname' => 'Имя продавца',
        'city' => 'Город',
        'rating' => 'Рейтинг',
        'cnum' => 'Номер покупателя',
        'cname' => 'Имя покупателя',
        // Добавьте остальные столбцы...
    ];

    $result = $mysqli->query("SELECT * FROM $table");
    if ($result) {
        echo "<h4>Содержимое таблицы $table</h4>";
        echo "<table border='1'>";

        echo "<tr>";
        while ($field = $result->fetch_field()) {
            $field_name = $field->name;
            echo "<th>" . (isset($rus_name[$field_name]) ? $rus_name[$field_name] : $field_name) . "<br>" . $field_name . "</th>";
        }
        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Ошибка при получении содержимого таблицы.";
    }
}

if (isset($_GET['structure']) || isset($_GET['content'])) {
    $tables = array_unique(array_merge($_GET['structure'] ?? [], $_GET['content'] ?? []));
    foreach ($tables as $table) {
        if (in_array($table, $_GET['structure'] ?? [])) {
            vid_structure($table);
        }
        if (in_array($table, $_GET['content'] ?? [])) {
            vid_content($table);
        }
    }
} else {
    echo "Не выбрана таблица.";
}
?>