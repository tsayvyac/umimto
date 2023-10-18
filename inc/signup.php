<?php

    session_start();
    require_once 'connect.php';

    $_SESSION['username'] = htmlentities($_POST['username']);
    $_SESSION['email'] = htmlentities($_POST['email']);
    $_SESSION['date'] = date("Y-m-d", strtotime($_POST['date']));
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $email = $_POST['email'];
    $date_of_birth = $_POST['date_of_birth'];

    $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `username` = '$username'");
    if (mysqli_num_rows($check_user) === 0) {
        if ($password === $password_confirm) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            mysqli_query($connect, "INSERT INTO `users` (`id`, `username`, `password`, `email`, `date_of_birth`) VALUES (NULL, '$username', '$password', '$email', '$date_of_birth')
            ");
            header('Location: ../login.php');
            $_SESSION['success'] = 'Registrace proběhla uspěšně!';
        } else {
            $_SESSION['failed'] = 'Hesla se neshodují';
            header('Location: ../registrace.php');
        }
    } else {
        $_SESSION['failed'] = 'Uživatelské jméno je již obsazeno';
        header('Location: ../registrace.php');
    }
?>