<?php
$dsn = 'mysql:host=localhost;dbname=project';
$user = 'root';
$password = '';

try {
    $connection = new PDO($dsn, $user, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Failed to connect with database' . $e->getMessage() . $e->getCode();
}
