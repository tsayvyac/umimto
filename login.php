<?php
    session_start();

    if (isset($_SESSION['user'])) {
        header('Location: profile.php');
    }
?>

<!DOCTYPE html>
<html lang="cs">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles/logstyle.css">
        <link rel="stylesheet" media="print" href="styles/print.css" />
        <link rel="icon" href="images/logo.png">
    </head>
    <body>
        <div class="container">
            <form action="inc/signin.php" method="post" class="form" id="login">
                <?php
                    if (isset($_SESSION['success'])) {
                        echo '<div class="acpt"><small>'. $_SESSION['success'] .'</small></div>';
                    }
                    unset($_SESSION['success']);
                ?>
                <h1 class="form__title">Přihlášení</h1>
                <?php
                    if (isset($_SESSION['message'])) {
                        echo '<div class="error__msg"><small>'. $_SESSION['message'] .'</small></div>';
                    }
                    unset($_SESSION['message']);
                ?>
                <div class="form__control">
                    <label>Uživatelské jméno:</label>
                    <input type="text" name="username" class="inputs" value="<?php if(isset($_SESSION['username'])){ echo htmlspecialchars($_SESSION['username']); } unset($_SESSION['username']); ?>" id="loguser" required>
                </div>
                <div class="form__control">
                    <label>Heslo:</label>
                    <input type="password" name="password" class="inputs" id="logpass" required>
                </div>
                <button class="form__button" type="submit">Přihlásit se</button>
                <div class="registrace">
                    <a href="registrace.php">Registrace</a>
                </div>
            </form>
        </div>
    </body>
</html>