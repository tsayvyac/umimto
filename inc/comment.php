<?php

    session_start();
    require_once 'connect.php';

    $comment = htmlspecialchars($_POST['comment']);
    $taskId = $_POST['task_id'];

    mysqli_query($connect, "INSERT INTO `reply`(`id`, `taskID`, `reply`, `dateOfCreate`, `userID`) VALUES (NULL,'$taskId','$comment', NOW(), '".$_SESSION['user']['id']."')");
    header('Location: ../answer.php');
?>