<?php
$team_number = '04'; // Replace 'NN' with your team number
$filename = "notebook_br$team_number.txt";
$table_name = "notebook_br$team_number";

// Check if the file exists
if (file_exists($filename)) {
    echo "<p>файл $filename существует</p>";
} else {
    // Create the file
    $file = fopen($filename, 'w');
    if (!$file) {
        die("Не удалось создать файл.");
    }
    fclose($file);
}

// Open the file for writing
$file = fopen($filename, 'w');
if (!$file) {
    die("Не удалось открыть файл для записи.");
}

// Connect to the database
$mysqli = new mysqli('mysql', 'root', 'example_password', 'sample', 3306);
if ($mysqli->connect_errno) {
    die("Connect Error: " . $mysqli->connect_error);
}

// Fetch data from the table
$result = $mysqli->query("SELECT * FROM $table_name");
if (!$result) {
    die("Ошибка при получении данных из таблицы.");
}

// Process each row
while ($row = $result->fetch_assoc()) {
    $line = [];
    foreach ($row as $column => $value) {
        // Replace date format from YYYY-MM-DD to DD-MM-YYYY
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
            $value = preg_replace('/(\d{4})-(\d{2})-(\d{2})/', '$3-$2-$1', $value);
        }
        $line[] = $value;
    }
    // Write the line to the file
    fwrite($file, implode(' | ', $line) . "\n");
}

// Close the file
fclose($file);

// Reopen the file for reading
$file = fopen($filename, 'r');
if (!$file) {
    die("Не удалось открыть файл для чтения.");
}

// Read and display the file contents
while (($line = fgets($file)) !== false) {
    echo htmlspecialchars($line) . "<br>";
}

// Close the file
fclose($file);

// Close the database connection
$mysqli->close();
?>