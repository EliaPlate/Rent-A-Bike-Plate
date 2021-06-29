<?php

require_once 'inc/db.inc.php';
require_once 'inc/functions.inc.php';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/2deba413ff.js" crossorigin="anonymous"></script>
    <title>Registrieren</title>
</head>

<body>
    <div class="errors">
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyinput") {
                echo "<p id='warning_input'>Fülle bitte alle Felder aus!</p>";
            } else if ($_GET['error'] == "invalidusername") {
                echo "<p id='error_pwd'>Wähle bitte einen validen Namen aus!</p>";
            } else if ($_GET['error'] == "humanexist") {
                echo "<p id='error_pwd'>Der Vor/Nach -name ist bereits vergeben!</p>";
            } else if ($_GET['error'] == "invalidemail") {
                echo "<p id='error_pwd'>Wähle bitte eine valide E-Mail!</p>";
            } else if ($_GET['error'] == "usernametaken") {
                echo "<p id='error_pwd'>Dieser Benutzername existiert bereits!</p>";
            } else if ($_GET['error'] == "passworddontmatch") {
                echo "<p id='error_pwd'>Die Passwörter stimmen nicht überein.</p>";
            } else if ($_GET['error'] == "SELECTFAILED") {
                echo "<p id='error_pwd'>Irgendetwas ist schiefgelauen, probiere nochmal.</p>";
                echo "<br><br>";
                echo "Error Code: 1";
            } else if ($_GET['error'] == "INPUTFAILED") {
                echo "<p id='error_pwd'>Irgendetwas ist schiefgelauen, probiere nochmal.</p>";
                echo "<br><br>";
                echo "Error Code: 2";
            } else if ($_GET['error'] == "none") {
                echo "<p id='succes'>Erfolgreich registriert!</p>";
            }
        }
        ?>
    </div>


    <div class="header">
        <a href="index.php">
            <h2 class="logo">SMANGO
        </a>
        <img style="opacity: 0.3;" src="img/undraw_biking_kc4f.svg" alt="a" /></h1>
        <p class="logo__text__register">Wir freuen uns, Sie als neuen Kunden begrüßen zu dürfen!</p>

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
            <h1>Registrieren</h1>
            <form action="inc/signup.inc.php" method="POST">
                <div class="text__field">
                    <input type="text" name="firstname" required>
                    <span></span>
                    <label>Vorname</label>
                    <label hidden><i class="fas fa-times"></i></label>
                </div>
                <div class="text__field">
                    <input type="text" name="lastname" required>
                    <span></span>
                    <label>Nachname</label>
                </div>
                <div class="text__field">
                    <input type="text" name="telephone" required>
                    <span></span>
                    <label>Telefonnummer</label>
                </div>
                <div class="text__field">
                    <input type="text" name="street" required>
                    <span></span>
                    <label>Straße</label>
                </div>
                <div class="text__field">
                    <input type="text" name="email" required>
                    <span></span>
                    <label>E-Mail</label>
                </div>
                <div class="text__field">
                    <span></span>
                    <label style="margin-top: -25px;">Ort</label>
                    <?php
                    echo '<select name="postalcode" id="club_register_dropdown">';
                    $query = $conn->query("SELECT name FROM ort");
                    while ($row = $query->fetch_assoc()) {
                        echo "<option name='postalcode' value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                    }
                    echo "<span></span>";
                    echo "</select> <br>";
                    ?>
                </div>
                <div class="text__field">
                    <input type="password" class="pwd" id="pwd" name="pwd" required>
                    <span></span>
                    <label>Passwort <i style="color: red;" id="pwd_validity">✖</i></label>
                    <i class="far fa-eye" id="pwd_eye"></i>
                </div>
                <div class="text__field">
                    <input type="password" class="pwd" id="pwdRepeat" name="pwdRepeat" required>
                    <span></span>
                    <label>Wiederhole Passwort <i style="color: red;" id="pwd_validity_repeat">✖</i></label>
                    <i class="far fa-eye" id="pwd_eye_repeat"></i>
                </div>

                <input type="submit" class="btn" id="signup_submit" name="submit" value="Registrieren">

                <div class="signup__link">
                    Bereits einen Account? <a href="./login.php">Einloggen</a>
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

</html>