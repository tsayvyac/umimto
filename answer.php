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
            <form action="" method="GET">
                <input type="text" name="search"placeholder="Hledat zadání" class="header__input" value="<?php if(isset($_GET['search'])){ echo htmlspecialchars($_GET['search']); } ?>">
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
                $resultPerPage = 7;
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
                $reply = mysqli_query($connect, "SELECT * FROM reply INNER JOIN users ON reply.userID = users.id");
                $replyRow = mysqli_fetch_assoc($reply);
                if(!isset($_SESSION['user'])) {
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
                            </div>
                        </div>
                        ';
                        echo 
                        '
                        <div class="subj '.$row['subject'].' label">Odpovedi</div>
                            <div class="content">
                                <div class="comments">
                                    <p class="test">Komentáře nefungují!</p>
                                </div>
                            </div>
                        ';
                    }
                }
                if(!isset($_GET['search'])){
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
                            </div>
                        </div>
                        ';
                        echo 
                        '
                        <div class="subj '.$row['subject'].' label">Odpovedi</div>
                        <div class="content">
                            <form method="post" action="inc/comment.php" class="comment__form" id="com__form">
                                <textarea id="comment" name="comment" placeholder="Napište sem odpověď"></textarea>
                                <button type="submit" name="task_id" value='.$row['taskId'].' id="addCom">Odpovědět</button>
                                <div class="comments">
                                    <p class="test">Komentáře nefungují!</p>
                                </div>
                            </form>
                        </div>
                        ';
                    }
                } else {
                    $searchValue = htmlspecialchars($_GET['search']);
                    $searchQuery = mysqli_query($connect, "SELECT * FROM tasks INNER JOIN users ON tasks.userID = users.id WHERE task LIKE '%$searchValue%' ORDER BY tasks.dateOfCreate $sort");
                    if(mysqli_num_rows($searchQuery) > 0) {
                        foreach($searchQuery as $searchResult){
                            echo 
                            '
                            <div class="questions">
                                <div class="border__main '.$searchResult['subject'].'">
                                    <div class="author">
                                        <p class="subj '.$searchResult['subject'].'">'.$searchResult['subject'].'</p>
                                        <div class="inform__post">
                                            <small>'.date("d.m.Y H:i", strtotime($searchResult['dateOfCreate'])).'</small>
                                            <h4>'.$searchResult['username'].' #'.$searchResult['userID'].'</h4>
                                        </div>
                                    </div>
                                    <div class="descrip__main">
                                        '.$searchResult['task'].'
                                    </div>
                                </div>
                            </div>
                            ';
                            echo 
                            '
                            <div class="subj '.$searchResult['subject'].' label">Odpovedi</div>
                            <div class="content">
                                <form method="post" action="inc/comment.php" class="comment__form" id="com__form">
                                    <textarea id="comment" name="comment" placeholder="Napiste sem odpoved"></textarea>
                                    <button type="submit" name="task_id" value='.$searchResult['taskId'].' id="addCom">Odpovědět</button>
                                    <div class="comments">
                                        <p class="test">Komentáře nefungují!</p>
                                    </div>
                                </form>
                            </div>
                            ';
                        }
                    } else {
                        echo '<div class="error">Nebylo nalezeno žádné zadání</div>';
                    }
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
                    } else if(isset($_GET['search'])) {
                        echo '';
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
        <script src="scripts/script.js"></script>
    </body>
</html>