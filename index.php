<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="cs">
    <head>
        <title>Umimto – zeptej se na cokoliv</title>
        <meta charset="utf-8">
        <meta name="description" content="Umimto.cz je webová stránka, na které ses můžeš zeptat na cokoliv u jiné.">
        <meta name="keywords" content="umimto, umim, domaci ukoly, umím to, umímto">
        <link rel="stylesheet" href="styles/style.css">
        <link rel="stylesheet" media="print" href="styles/print.css" />
        <link rel="icon" href="images/logo.png">
        <script src="https://kit.fontawesome.com/e9507d774b.js" crossorigin="anonymous"></script>
        <script src="scripts/script.js"></script>
        <script src="scripts/animation.js"></script>
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
            <div class="border__main">
                <div class="text__main">
                    <h3>Od otázky<br>k porozumění</h3>
                </div>
                <div class="descrip__main">
                    UmimTo je webová stránka, na něž můžete najít nebo poprosit o pomoc s domácími úkoly u jiných lidí. 
                    Je zde shromážděno více než 300 domácích úkolů z různých předmětů.
                </div>
            </div>
            <div class="block1" id="block1">
                <a href="otazky.php">Máš dotaz?</a>
                <a href="answer.php">Najít odpověď</a>
            </div>
            <div class="verif__icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h3 class="main__h3">Společně víme víc. Využijte znalosti jiných studentů z celého světa</h3>
            <div class="rules">
                <p class="text1">1. Zeptej se</p>
                <p class="text2">2. Dostaň odpověď</p>
                <p class="text3">3. Pomoz jiným</p>
            </div>
        </div>
        <div class="end__block">
            <div class="end__block--content">
                <h3>Co chceš pochopit?</h3>
                <h4>
                    Neexistují příliš snadné nebo příliš obtížné otázky, existují dobré odpovědi. 
                    Pokud jste uvízli při přípravě na zkoušku - přijďte na UmimTo.
                </h4>
            </div>
            <div>
                <a href="otazky.php">Máš dotaz?</a>
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
                    <a href="mailto:ask@umimto.cz">Kontaktujte nás</a>
                </div>
            </div>
            <div class="copyright">
                <small>© 2021 ČVUT FEL SIT tsayvyac</small>
            </div>
        </footer>
    </body>
</html>