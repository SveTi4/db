<?php
$team_number = '04'; // Замените 'NN' на номер вашей команды
$filename = "notebook_br$team_number.txt";

// Выводим путь к файлу для отладки
echo "<p>Путь к файлу: " . realpath($filename) . "</p>";

// Проверяем, существует ли файл
if (file_exists($filename)) {
    // Читаем файл в массив
    $file_array = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
} else {
    die("Файл $filename не существует. Проверьте путь и права доступа.");
}

// Создаем HTML-таблицу
echo '<table border="1" cellpadding="10">';

// Обрабатываем каждую строку в массиве
foreach ($file_array as $line) {
    // Уд��ляем конечные символы "| \n"
    $line = rtrim($line, " | \n");

    // Заменяем "|" на "</td><td>"
    $line = str_replace(" | ", "</td><td>", $line);

    // Заменяем email на mailto ссылку
    $line = preg_replace('/([^\s]+@[^\s]+)/', '<a href="mailto:$1">$1</a>', $line);

    // Выводим строку как строку таблицы
    echo "<tr><td>$line</td></tr>";
}

echo '</table>';

// Выводим дату и время последней модификации файла
echo '<p>Последняя модификация файла: ' . date("d-m-Y H:i:s", filemtime($filename)) . '</p>';
?>