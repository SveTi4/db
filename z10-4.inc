<?php
$mysqli = new mysqli('mysql', 'root', 'example_password', 'sample', 3306);

if ($mysqli->connect_errno) {
    die("Connect Error: " . $mysqli->connect_error);
}
?>