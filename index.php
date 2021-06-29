<?php
session_start();
?>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/2deba413ff.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Hauptseite</title>
</head>

<body>

    <div class="header">
        <a href="index.php">
            <h2 class="logo" id="logo">SMANGO
        </a><img src="img/undraw_biking_kc4f.svg" alt="a" /></h2>

        <p class="logo__text">Ermöglich deine Fahrradtour mit deinem gemieteten E-Bike</p>
        <div class="logo__href__text">
            <a href="user/index.php">Jetzt Mieten</a>
        </div>

        <input type="checkbox" id="chk">
        <label for="chk" class="show-menu-btn">
            <i class="fas fa-ellipsis-h"></i>
        </label>

        <?php

        if (isset($_SESSION['role'])) {
            if (strcasecmp($_SESSION['role'], "admin") == 0) {
                echo '<ul class="menu">';
                echo '<a href="adminpanel/index.php">Ihr Konto</a>';
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
                echo '<a href="user/index.php">Ihr Konto</a>';
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
    <div class="datenschutz__impressum">
        <ul>
            <li>
                <a href="impressum.html">Impressum</a>
            </li>
            <li>
                <a href="privacy.html">Datenschutz</a>
            </li>
        </ul>
    </div>




    <footer><i class="far fa-copyright"> Copyright 2021</i></footer>
</body>

</html>