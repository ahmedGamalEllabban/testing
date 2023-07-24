<?php
$dsn = 'mysql:host=bwqo9wjftzjivk3xumhe-mysql.services.clever-cloud.com;dbname=bwqo9wjftzjivk3xumhe';
$user = 'unhrw2fljxhj82eu';
$password = 'x4dd66dpaJPlJJy8ZDwg';

try {
    $connection = new PDO($dsn, $user, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Failed to connect with database' . $e->getMessage() . $e->getCode();
}
