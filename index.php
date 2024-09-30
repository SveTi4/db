<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.php">Lab1</a>
    <a href="z09-1.php">Lab3 Создание бд</a>
    <a href="z09-2.php">Lab3 Заполнение бд</a>
    <a href="z09-3.php">Lab3 Вывод бд</a>
    <a href="z09-4.php">Lab3 Редактирование бд</a>
    <a href="z10-1.html">Lab4</a>
    <h1>Lab1</h1>
    <h2>Задание 1</h2>
    <?php
    // Задание 1
    $color = "blue";  // цвет текста
    $size = "24px";   // размер текста

    echo "<p style='color: $color; font-size: $size;'>Это строка с текстом, цвет и размер которого заданы переменными.</p>";
    ?>
    <h2>Задание 2</h2>
    <?php
    // Задание 2
    $var1 = "Alice";
    $var2 = "My friend is $var1";
    $var3 = 'My friend is $var1';
    echo "<p>$var2</p>";
    echo "<p>$var3</p>";

    $var4 = &$var1;
    echo "<p>$var1</p>";
    echo "<p>$var2</p>";
    echo "<p>$var3</p>";
    echo "<p>$var4</p>";

    $var1 = "Bob";
    echo "<p>$var1</p>";
    echo "<p>$var2</p>";
    echo "<p>$var3</p>";
    echo "<p>$var4</p>";

    $user = "Michael";
    $$user = "Jackson";

    echo "<p>\$user = $user</p>";
    echo "<p>\$user =" . $Michael . "</p>";
    ?>

    <h2>Задание 3</h2>
    <?php
    // Задание 3
    $e = 2.718281;
    echo "<p>Тип переменной \$e - " . gettype($e) . ", значение - $e</p>";
    $e = (string) $e;
    echo "<p>Тип переменной \$e - " . gettype($e) . ", значение - $e</p>";
    $e = (int) $e;
    echo "<p>Тип переменной \$e - " . gettype($e) . ", значение - $e</p>";
    $e = (bool) $e;
    echo "<p>Тип переменной \$e - " . gettype($e) . ", значение - $e</p>";
    ?>

    <h2>Задание 4</h2>
    <?php
    // Задание 4
    // Получаем значение переменной $p из GET-запроса
    $p = isset($_GET['p']) ? $_GET['p'] : null;

    if ($p === null) {
        echo "<p>Значение переменной p не передано.</p>";
    } else {
        // Приводим $p к числу, чтобы избежать ошибок при сравнении
        $p = (int)$p;

        // Проверяем значение переменной $p
        switch (true) {
            case ($p >= -5 && $p <= 2):
                // Функция для вывода числа словами (например, число 1 -> "один")
                echo "<p>Число в пределах от -5 до 2: $p.</p>";
                break;

            default:
                echo "<p>Предупреждение: неверное значение. Повторите ввод.</p>";
                break;
        }
    }
    ?>

    <h2>Задание 5</h2>
    <?php
    // Задание 5
    $diagColor = "#aaa";
    echo "<table style='border: 1px solid black; border-collapse: collapse; text-align: center;'>\n";
    $i = 1;
    while ($i <= 10) {
        echo "  <tr>\n";
        $j = 1;
        while ($j <= 10) {
            $style = ($i == $j) ? " style='background-color: $diagColor;'" : "";
            echo "    <td$style style='border: 1px solid black; padding: 5px;'>" . ($i * $j) . "</td>\n";
            $j++;
        }
        echo "  </tr>\n";
        $i++;
    }
    echo "</table>\n";
    ?>
</body>
</html>