<?php
    session_start();
    require_once 'connect.php';

    $task = htmlspecialchars($_POST['task']);
    $subject = $_POST['subject'];
    mysqli_query($connect, "INSERT INTO `tasks`(`taskId`, `userID`, `task`, `dateOfCreate`, `subject`) VALUES (NULL, '".$_SESSION['user']['id']."', '$task', NOW(), '$subject')");
    echo 'successful test';
?>