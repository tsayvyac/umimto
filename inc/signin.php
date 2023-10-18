<?php

    session_start();
    require_once 'connect.php';

    $_SESSION['username'] = htmlentities($_POST['username']);
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `username` = '$username'");
    
    if (mysqli_num_rows($check_user) === 1) {
        $user = mysqli_fetch_assoc($check_user);
        $hash = $user['password'];
        
        if (password_verify($password, $hash)) {
            $_SESSION['user'] = [
                "id" => $user['id'],
                "username" => $user['username'],
                "email" => $user['email'],
                "date" => $user['date_of_birth']
            ];
            header('Location: ../profile.php');
        } else {
            $_SESSION['message'] = 'Špatně zadané uživatelské jméno nebo heslo';
            header('Location: ../login.php');
        }
    } else {
        $_SESSION['message'] = 'Špatně zadané uživatelské jméno nebo heslo';
        header('Location: ../login.php');
    }
    
?>