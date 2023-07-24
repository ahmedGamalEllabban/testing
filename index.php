<?php
session_start();
require('user_validation.php');
if (isset($_POST['save'])) {
    $validation = new user_validate($_POST);
    $errors = $validation->validate_form();
    if (empty($errors)) {
        require('crud.php');
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="water-dark.css">
    <title>Signup</title>
</head>

<body>
    <?php if (isset($_SESSION['message'])) : ?>
        <h5 class="success"><?php echo $_SESSION['message']; ?></h5>
    <?php
        unset($_SESSION['message']);
        header("Refresh:3; url=index.php");
    endif ?>
    <form action="" method="post">
        <label>Username</label>
        <input type="text" placeholder="Enter Username" name="username" value="<?php echo htmlspecialchars($_POST['username'] ?? '') ?>">
        <div class="error"><?php echo $errors['username'] ?? '' ?></div>
        <hr>

        <label>Email</label>
        <input type="email" placeholder="Enter Email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? '') ?>">
        <span class="error"><?php echo $errors['email']  ?? '' ?> </span>
        <span class="error"><?php echo $data_errors['email']  ?? '' ?> </span>
        <hr>

        <label>Password</label>
        <input type="password" placeholder="Enter Password" name="password" value="<?php echo htmlspecialchars($_POST['password'] ?? '') ?>">
        <span class="error"><?php echo $errors['password'] ?? '' ?></span>
        <hr>

        <label>Repeat Password</label>
        <input type="password" placeholder="Repeat Password" name="repeated_password" value="<?php echo htmlspecialchars($_POST['repeated_password'] ?? '') ?>">
        <div class="error"><?php echo $errors['repeated_password'] ?? '' ?></div>
        <hr>

        <button type="submit" name="save">Signup</button>
    </form>
</body>

</html>