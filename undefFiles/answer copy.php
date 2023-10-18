<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="cs">
    <head>
        <title>Umimto – zeptej se na cokoliv</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" media="print" href="print.css" />
        <link rel="icon" href="logo.png">
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
            <div class="filters">
                <form action="" method="get">
                    <div class="sorting__v">
                        <select name="sorting">
                            <option selected disabled>Podle data</option>
                            <option value="desc">Od nejnovejšího</option>
                            <option value="asc">Od nejstaršího</option>
                        </select>
                        <select name="filter">
                            <option selected disabled>Podle předmětů</option>
                            <option value="vse">Vše</option>
                            <option value="mat">Matematika</option>
                            <option value="fyz">Fyzika</option>
                            <option value="bio">Biologie</option>
                            <option value="che">Chemie</option>
                            <option value="alg">Algoritmizace</option>
                            <option value="ccc">C</option>
                            <option value="pyt">Python</option>
                        </select>
                        <button type="submit">Seřadit</button>
                    </div>
                </form>
            </div>
            <?php
                include 'inc/connect.php';
                $subjects = "";
                $sort = "DESC";
                if(isset($_GET['sorting'])){
                    if($_GET['sorting'] == 'asc'){
                        $sort = "ASC";
                    } else if($_GET['sorting'] == 'desc') {
                        $sort = "DESC";
                    }
                }
                if(isset($_GET['filter'])){
                    if($_GET['filter'] == 'mat'){
                        $subjects = "WHERE subject = 'Matematika'";
                    } else if($_GET['filter'] == 'fyz') {
                        $subjects = "WHERE subject = 'Fyzika'";
                    } else if($_GET['filter'] == 'bio') {
                        $subjects = "WHERE subject = 'Biologie'";
                    } else if($_GET['filter'] == 'che') {
                        $subjects = "WHERE subject = 'Chemie'";
                    } else if($_GET['filter'] == 'ccc') {
                        $subjects = "WHERE subject = 'C'";
                    } else if($_GET['filter'] == 'pyt') {
                        $subjects = "WHERE subject = 'Python'";
                    } else if($_GET['filter'] == 'alg') {
                        $subjects = "WHERE subject = 'Algoritmizace'";
                    } else {
                        $subjects = '';
                    }
                }
                $result = mysqli_query($connect, "SELECT * FROM `tasks` INNER JOIN users ON tasks.userID = users.id $subjects");
                $resultPerPage = 5;
                $numOfResults = mysqli_num_rows($result);
                $numberOfPage = ceil($numOfResults/$resultPerPage);
                if(!isset($_GET['page'])) {
                    $page = 1;
                } else {
                    $page = $_GET['page'];
                }
                $firstPageResult = ($page-1)*$resultPerPage;
                $sql = "SELECT * FROM tasks INNER JOIN users ON tasks.userID = users.id $subjects ORDER BY tasks.dateOfCreate $sort LIMIT $firstPageResult, $resultPerPage";
                $res = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_assoc($res)) {
                    echo 
                    '
                    <div class="questions">
                        <div class="border__main '.$row['subject'].'">
                            <div class="author">
                                <p class="subj '.$row['subject'].'">'.$row['subject'].'</p>
                                <div class="inform__post">
                                    <small>'.date("d.m.Y H:i", strtotime($row['dateOfCreate'])).'</small>
                                    <h4>'.$row['username'].' #'.$row['userID'].'</h4>
                                </div>
                            </div>
                            <div class="descrip__main">
                                '.$row['task'].'
                            </div>
                            <div class="accor">
                                <div class="contentBx">
                                    <div class="label subj '.$row['subject'].'">Odpovedi</div>
                                    <div class="content">
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
            <div class="pages">
                <?php
                    if(isset($_GET['sorting']) && isset($_GET['filter'])){
                        for($page=1;$page<=$numberOfPage;$page++){
                            echo 
                            '
                            <a href="answer.php?sorting='.$_GET['sorting'].'&filter='.$_GET['filter'].'&page=' . $page .'" class="pagination">' . $page . '</a>
                            ';
                        }
                    } else if(isset($_GET['filter'])){
                        for($page=1;$page<=$numberOfPage;$page++){
                            echo 
                            '
                            <a href="answer.php?filter='.$_GET['filter'].'&page=' . $page .'" class="pagination">' . $page . '</a>
                            ';
                        }
                    } else if(isset($_GET['sorting'])){
                        for($page=1;$page<=$numberOfPage;$page++){
                            echo 
                            '
                            <a href="answer.php?sorting='.$_GET['sorting'].'&page=' . $page .'" class="pagination">' . $page . '</a>
                            ';
                        }
                    } else {
                        for($page=1;$page<=$numberOfPage;$page++){
                            echo 
                            '
                            <a href="answer.php?&page=' . $page .'" class="pagination">' . $page . '</a>
                            ';
                        }
                    }
                ?>
            </div>
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
        <script src="script.js"></script>
    </body>
</html>