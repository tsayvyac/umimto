<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="cs">
    <head>
        <title>Umimto – zeptej se na cokoliv</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles/style.css">
        <link rel="stylesheet" href="styles/styleotaz.css">
        <link rel="stylesheet" media="print" href="styles/print.css" />
        <link rel="icon" href="logo.png">
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
        <div class="mainotaz">
            <form name="ajaxForm" id="ajaxForm" method="post">
                <div class="layout">
                    <div class="task__container" id="taskId">
                        <p>Hledáte odpověď na otázku, se kterou potřebujete pomoci?</p>
                        <?php
                            if(isset($_SESSION['user'])) {
                                echo
                                '
                                <textarea id="textareaId" name="task" maxlength="1000" placeholder="Stručně napište zde svou otázku" required></textarea>
                                <div class="subjects">
                                    <select name="subject">
                                        <option value="Matematika">Matematika</option>
                                        <option value="Chemie">Chemie</option>
                                        <option value="Fyzika">Fyzika</option>
                                        <option value="Python">Python</option>
                                        <option value="C">C</option>
                                        <option value="Algoritmizace">Algoritmizace</option>
                                        <option value="Biologie">Biologie</option>
                                    </select>
                                </div>
                                <div class="btn__task">
                                    <button type="submit">Poslat</button>
                                </div>
                                ';
                            } else {
                                echo
                                'Musíte 
                                <a href="login.php">se přihlásit</a>.';
                            }
                        ?>
                    </div>
                    <div class="layout__aside">
                        <h1>NA 80% OTÁZEK ODPOVÍDAJÍ JIŽ ZA 10 MINUT</h1>
                    </div>
                </div>
            </form>
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
        <script>
            document.forms.ajaxForm.onsubmit = function(e){
            e.preventDefault();

            var input = document.forms.ajaxForm.task.value;
            input = encodeURIComponent(input);
            var xhr = new XMLHttpRequest();
            
            xhr.open('POST', 'inc/task.php');
            
            var formData = new FormData(document.forms.ajaxForm);

            xhr.onreadystatechange = function(){
                if(xhr.readyState === 4 && xhr.status === 200) {
                alert('Otázka byla úspěšně přidána!');
                }
            }

            xhr.send(formData);
            };
        </script>
    </body>
</html>