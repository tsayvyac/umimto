<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="cs">
    <head>
        <title>Umimto – zeptej se na cokoliv</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="styleotaz.css">
        <link rel="stylesheet" media="print" href="print.css" />
        <link rel="icon" href="logo.png">
        <script src="https://kit.fontawesome.com/e9507d774b.js" crossorigin="anonymous"></script>
        <script src="script.js"></script>
    </head>
    <body>
        <header id="header">
            <div class="header__nav--logo">
                <a href="index.php" class="a__logo">UMIMTO</a>
            </div>
            <form action="#" method="GET">
                <input type="search" placeholder="Hledat" class="header__input">
                <button type="submit">
                    <img class="header__search--btn" src="search.png" alt="search icon">
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
            <div class="layout">
                <div class="task__container">
                    <div class="inf__qus">
                        <h4>st1ng #52</h4>
                        <small>Matematika</small>
                    </div>
                    <h1>Určete číslo „k“ tak, aby jeden kořen rovnice x2-5x+k=0 byl x1=3</h1>
                </div>
            </div>
            <div class="odpovedi">
                <p>Odpovědi:</p>
                <?php
                    if(isset($_SESSION['user'])) {
                        echo
                        '
                        <form method="post" action="inc/comment.php" class="comment__form" id="com__form">
                            <textarea id="comment" name="comment" placeholder="Napiste sem odpoved"></textarea>
                            <button type="submit" id="addCom">Odpovědět</button>
                        </form>
                    ';
                    } else {
                        echo
                        '';
                    }
                ?>
                <div class="userAnswer">
                    <div class="ans">
                        <div class="user"></div>
                        <div class="comm"></div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="footer__content">
                <div class="footer__logo">
                    <h3>UMIMTO</h3>
                    <p>Společně víme víc</p>
                    <div class="social">
                        <a href="https://www.instagram.com/" id="instagram" class="fab fa-instagram"></a>
                        <a href="https://twitter.com/" id="twitter" class="fab fa-twitter"></a>
                        <a href="https://www.facebook.com/" id="facebook" class="fab fa-facebook-square"></a>
                    </div>
                    <i class="far fa-moon" id="icon" onclick="darkTheme()"></i>
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
    </body>
</html>