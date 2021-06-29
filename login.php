<?php
session_start();
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/2deba413ff.js" crossorigin="anonymous"></script>
    <title>Login</title>
</head>

<body>
    <div class="errors">
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyinput") {
                echo "<div id='warning_input'>Fülle bitte alle Felder aus!</div>";
            } else if ($_GET['error'] == "wronglogin1") {
                echo "<div id='error_pwd'>Dein Passwort oder Benutzername/E-Mail ist falsch!</div>";
            } else if ($_GET['error'] == "wronglogin2") {
                echo "<div id='error_wpwd'>Dein Passwort oder Benutzername/E-Mail ist falsch!</div>";
            }
        }
        ?>
    </div>

    <div class="header">
        <a href="index.php">
            <h2 class="logo">SMANGO
        </a>
        <img style="opacity: 0.3;" src="img/undraw_biking_kc4f.svg" alt="a" /></h1>
        <p class="logo__text">Ermöglich deine Fahrradtour mit deinem gemieteten E-Bike</p>


        <input type="checkbox" id="chk">
        <label for="chk" class="show-menu-btn">
            <i class="fas fa-ellipsis-h"></i>
        </label>

        <?php

        if (isset($_SESSION['role'])) {
            if (strcasecmp($_SESSION['role'], "admin") == 0) {
                echo '<ul class="menu">';
                echo '<a href="gallery.php">Gallerie</a>';
                echo '<a href="admin/managment.php">Verwaltung</a>';
                echo '<a href="admin/repair.php">Reparatur</a>';
                echo '<a href="inc/logout.inc.php">Ausloggen</a>';
                echo '<label for="chk" class="hide-menu-btn">';
                echo '<i class="fas fa-times"></i>';
                echo '</label>';
                echo '</ul>';
            } else if (strcasecmp($_SESSION['role'], "user") == 0) {
                echo '<ul class="menu">';
                echo '<a href="index.php">Home</a>';
                echo '<a href="gallery.php">Gallerie</a>';
                echo '<a href="user/index.php">E-Bike mieten</a>';
                echo '<a href="inc/logout.inc.php">Ausloggen</a>';
                echo '<label for="chk" class="hide-menu-btn">';
                echo '<i class="fas fa-times"></i>';
                echo '</label>';
                echo '</ul>';
            } else {
                echo '<ul class="menu">';
                echo '<a href="index.php">Home</a>';
                echo '<a href="gallery.php">Gallerie</a>';
                echo '<a href="signup.php">Registrieren</a>';
                echo '<a href="login.php">Login</a>';
                echo '<label for="chk" class="hide-menu-btn">';
                echo '<i class="fas fa-times"></i>';
                echo '</label>';
                echo '</ul>';
            }
        } else {
            echo '<ul class="menu">';
            echo '<a href="index.php">Home</a>';
            echo '<a href="gallery.php">Gallerie</a>';
            echo '<a href="signup.php">Registrieren</a>';
            echo '<a href="login.php">Login</a>';
            echo '<label for="chk" class="hide-menu-btn">';
            echo '<i class="fas fa-times"></i>';
            echo '</label>';
            echo '</ul>';
        }
        ?>
    </div>

    <div class="center">
        <section class="input__form">
            <h1>Einloggen</h1>
            <form action="./inc/login.inc.php" method="POST">
                <div class="text__field">
                    <input type="text" name="firstname" required>
                    <span></span>
                    <label>Vorname/E-Mail</label>
                </div>
                <div class="text__field">
                    <input type="password" name="pwd" class="pwd" id="pwd" required>
                    <span></span>
                    <label>Passwort </label>
                    <i class="far fa-eye" id="pwd_eye"></i>
                </div>
                <input type="submit" class="btn" name="submit" value="Login">
                <div class="signup__link">
                    Kein Account? <a href="./signup.php">Registrieren</a>
                </div>
            </form>
        </section>
    </div>

    <div class="datenschutz__impressum">
        <ul>
            <li>
                <a href="impressum.php">Impressum</a>
            </li>
            <li>
                <a href="privacy.php">Datenschutz</a>
            </li>
        </ul>
    </div>


    <footer><i class="far fa-copyright"> Copyright 2021</i></footer>

</body>
<script src="./javascript/registration.js"></script>
<script src="./javascript/app.js"></script>

</html>