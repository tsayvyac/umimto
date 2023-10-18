<?php
    session_start();

    if (!isset($_SESSION['user'])) {
        header('Location: registrace.php');
    }
?>

<!DOCTYPE html>
<html lang="cs">
    <head>
        <title>Umimto – <?= $_SESSION['user']['username'] ?></title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles/style.css">
        <link rel="stylesheet" media="print" href="styles/print.css" />
        <link rel="icon" href="images/logo.png">
        <script src="https://kit.fontawesome.com/e9507d774b.js" crossorigin="anonymous"></script>
        <script src="scripts/script.js"></script>
    </head>
    <body>
        <header id="header">
            <div class="header__nav--logo">
                <a href="index.php" class="a__logo">UMIMTO</a>
            </div>
            <div class="wer">
                <a class="search__link" href="answer.php">
                    <input type="search" placeholder="Hledat zadání" class="header__input">
                    <button type="submit">
                        <img class="header__search--btn" src="images/search.png" alt="search icon">
                    </button>
                </a>
                <div class="menubar">
                    <i class="fas fa-bars" onclick="openMenu()"></i>
                </div>
            </div>
            <div class="hide__login--container" id="hide__login--containerID">
                <span>
                    <?php
                        if(isset($_SESSION['user'])) {
                            echo
                            '<a href="inc/logout.php" class="hide__login">Odhlásit se</a>';
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
                        '<a href="inc/logout.php" class="header__login">Odhlásit se</a>';
                    } else {
                        echo
                        '<a href="login.php" class="header__login">Přihlásit se</a>';
                    }
                ?>
            </span>
        </header>
        <div class="main">
            <div class="border__main">
                <div class="text__main">
                    <h3>Ahoj, <?= $_SESSION['user']['username'] ?>!</h3>
                </div>
                <div class="descrip__main">
                    <h3>Údaje o identitě:</h3>
                </div>
                <div class="row">
                    <div class="col">Uživatelské jméno:</div>
                    <div class="col2"><?= $_SESSION['user']['username']?></div>
                </div>
                <div class="row">
                    <div class="col">Osobní číslo:</div>
                    <div class="col2"><?= $_SESSION['user']['id']?></div>
                </div>
                <div class="row">
                    <div class="col">E-mail:</div>
                    <div class="col2"><?= $_SESSION['user']['email']?></div>
                </div>
                <div class="row">
                    <div class="col">Datum narození:</div>
                    <div class="col2"><?=date("d.m.Y", strtotime($_SESSION['user']['date']))?>  </div>
                </div>
            </div>
            <div><br><br><br><br><br><br></div>
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
                    <i class="far fa-moon" id="icon" onclick="darkTheme()"></i>
                </div>
                <div class="foot__links">
                    <p>Navigace</p>
                    <a href="login.php">Přihlásit se</a>
                    <a href="registrace.php">Registrace</a>
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