<?php
require('config.php');
session_start();

$user_name = $_POST['username'];
$user_email = $_POST['email'];
$password = $_POST['password'];
$hashed_password = password_hash($password, PASSWORD_ARGON2I);

$data_errors = [];
$query_one = 'SELECT email FROM users_new';
$stmt = $connection->prepare($query_one);
$stmt->execute();
$does_exist = false;

foreach ($stmt->fetchAll(PDO::FETCH_OBJ) as $row) {
    if ($row->email == $user_email) {
        $does_exist = true;
    }
}

if ($does_exist) {
    $data_errors['email'] = 'This Email Is Used Already';
} else {
    $add_query = 'INSERT INTO users_new (`user_name`, `email`, `password`) VALUES (:user_name, :email, :password)';
    $add_stmt = $connection->prepare($add_query);
    $data = [
        ':user_name' => $user_name,
        ':email' => $user_email,
        ':password' => $hashed_password
    ];
    $add_stmt->execute($data);
    $_SESSION['message'] = 'Added Successfully';
    header('Location:index.php');
    exit;
}
