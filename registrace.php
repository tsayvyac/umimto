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
            <form action="inc/signup.php" method="post" class="form" id="form">
                <h1 class="form__title">Registrace</h1>
                <?php
                    if (isset($_SESSION['failed'])) {
                        echo '<div class="error__msg"><small>'. $_SESSION['failed'] .'</small></div>';
                    }
                    unset($_SESSION['failed']);
                ?>
                <div class="form__control">
                    <label>Uživatelské jméno*:</label>
                    <input type="text" name="username" class="inputs" id="username" value="<?php if(isset($_SESSION['username'])){ echo htmlspecialchars($_SESSION['username']); } unset($_SESSION['username']); ?>" pattern="[a-zA-Z0-9]{3,}" required>
                    <small id="userOut"></small>
                </div>
                <div class="form__control">
                    <label>Heslo*:</label>
                    <input type="password" name="password" class="inputs" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                    <small id="passOut"></small>
                </div>
                <div class="form__control">
                    <label>Opakujte heslo*:</label>
                    <input type="password" name="password_confirm" class="inputs" id="passwordCheck" required>
                    <small id="passCheckOut"></small>
                </div>
                <div class="form__control">
                    <label>Email*:</label>
                    <input type="text" name="email" class="inputs" value="<?php if(isset($_SESSION['email'])){ echo htmlspecialchars($_SESSION['email']); } unset($_SESSION['email']); ?>" placeholder="example@mail.com" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                    <small id="emailOut"></small>
                </div>
                <div class="form__control">
                    <label>Datum narození*:</label>
                    <input type="date" name="date_of_birth" class="inputs" id="date" value="<?php if(isset($_SESSION['date'])){ echo htmlspecialchars($_SESSION['date']); } unset($_SESSION['date']); ?>" min="1940-01-01" max="2015-01-01" pattern="\d{4}-\d{2}-\d{2}" required>
                    <small id="dateOut"></small>
                </div>
                <button class="form__button" type="submit">Zaregistrovat se</button>
                <div class="registrace">
                    <a href="login.php">Máte účet?</a>
                </div>
            </form>
        </div>
        <script src="scripts/validation.js"></script>
    </body>
</html>