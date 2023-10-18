<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="cs">
    <head>
        <title>Umimto – zeptej se na cokoliv</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles/style.css">
        <link rel="stylesheet" media="print" href="styles/print.css" />
        <link rel="icon" href="images/logo.png">
        <script src="https://kit.fontawesome.com/e9507d774b.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <header id="header">
            <div class="header__nav--logo">
                <a href="index.php" class="a__logo">UMIMTO</a>
            </div>
            <form action="#" method="GET">
                <input type="search" placeholder="Hledat" class="header__input">
                <button type="submit">
                    <img class="header__search--btn" src="images/search.png" alt="search icon">
                </button>
                <div class="menubar">
                    <i class="fas fa-bars" onclick="openMenu()"></i>
                </div>
            </form>
            <div class="hide__login--container" id="hide__login--containerID">
                <span>
                    <?php
                        if(isset($_SESSION['user'])) {
                            echo
                            '<a href="login.php" class="hide__login">'.$_SESSION['user']['username'].'</a>';
                        } else {
                            echo
                            '<a href="login.php" class="hide__login">Přihlásit se</a>';
                        }
                    ?>
                </span>
            </div>
            <span>
                <?php
                    if(isset($_SESSION['user'])) {
                        echo
                        '<a href="login.php" class="header__login">'.$_SESSION['user']['username'].'</a>';
                    } else {
                        echo
                        '<a href="login.php" class="header__login">Přihlásit se</a>';
                    }
                ?>
            </span>
        </header>
        <div class="main">
            <div id="btn__container">
                <button class="btn active" onclick="filterSelection('all')">Vše</button>
                <button class="btn" onclick="filterSelection('Fyzika')">Fyzika</button>
                <button class="btn" onclick="filterSelection('Python')">Python</button>
                <button class="btn" onclick="filterSelection('Chemie')">Chemie</button>
                <button class="btn" onclick="filterSelection('Matematika')">Matematika</button>
                <button class="btn" onclick="filterSelection('Algoritmizace')">Algoritmizace</button>
                <button class="btn" onclick="filterSelection('C')">C</button>
                <button class="btn" onclick="filterSelection('Biologie')">Biologie</button>
            </div>
            <?php
                include 'inc/connect.php';
                $result = mysqli_query($connect, "SELECT * FROM `tasks` INNER JOIN users ON tasks.userID = users.id ORDER BY tasks.id DESC");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo 
                    '
                    <div class="questions '.$row['subject'].'">
                        <div class="border__main">
                            <div class="author">
                                <p>'.$row['subject'].'</p>
                                <div class="inform__post">
                                    <small>'.date("d.m.Y H:i", strtotime($row['dateOfCreate'])).'</small>
                                    <h4>'.$row['username'].' #'.$row['userID'].'</h4>
                                </div>
                            </div>
                            <div class="descrip__main">
                                '.$row['task'].'
                            </div>
                            <div class="help__ans">
                                <button type="button" class="accor">Odpovědi</button>
                                <div class="panel">
                                    <div class="odpovedi">
                                        <form method="post" action="" class="comment__form" id="com__form">
                                            <textarea id="comment" name="comment" placeholder="Napiste sem odpoved"></textarea>
                                            <button type="" id="addCom">Odpovědět</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
                }
            ?>
        </div>
        <footer>
            <div class="footer__content">
                <div class="footer__logo">
                    <h3>UMIMTO</h3>
                    <p>Společně víme víc</p>
                    <div class="social">
                        <a href="instagram.com" id="instagram" class="fab fa-instagram"></a>
                        <a href="twitter.com" id="twitter" class="fab fa-twitter"></a>
                        <a href="facebook.com" id="facebook" class="fab fa-facebook-square"></a>
                    </div>
                </div>
                <div class="foot__links">
                    <p>Navigace</p>
                    <a href="login.php">Přihlásit se</a>
                    <a href="registrace - test.php">Registrace</a>
                    <a href="otazky.php">Zeptat se</a>
                    <a href="answer.php">Najít odpovědi</a>
                    <?php
                        if(isset($_SESSION['user'])) {
                            echo '<a href="inc/logout.php">Odhlásit se</a>';
                        }
                    ?>
                </div>
                <div class="foot__links">
                    <p>Užitečné odkazy</p>
                    <a href="#">O nás</a>
                    <a href="#">NULL</a>
                    <a href="mailto:ask@umimto.cz">Kontaktujte nás</a>
                </div>
            </div>
            <div class="copyright">
                <small>© 2021 ČVUT FEL SIT tsayvyac</small>
            </div>
        </footer>
        <script src="scripts/script.js"></script>
    </body>
</html>