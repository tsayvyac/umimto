<?php
    setcookie();
    require_once 'connect.php';

    if($_COOKIE['theme'] == 'dark'){
        $style = "dstyle.css";
    } else {
        $style = "style.css";
    }
?>