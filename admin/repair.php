<?php
session_start();
require_once '../inc/db.inc.php';
require_once '../inc/functions.inc.php';
if (isset($_SESSION)) {
    if (!isAdmin($_SESSION)) {
        header("location: ../error/error_403_page.html");
    }
} else {
    header("location: ../error/error_403_page.html");
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <script src="https://kit.fontawesome.com/2deba413ff.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Reparatur</title>
</head>


<body>
    <div class="errors">
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyinput") {
                echo "<div id='warning_input'>Fülle bitte alle Felder aus!</div>";
            } else if ($_GET['error'] == "none") {
        ?>
                <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: "Die Reparatur wurde erfolgreich eingetragen!",
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
        <?php
                echo "<div id='success'></div>";
            } else if ($_GET['error'] == "error") {
                echo "<div id='error_wpwd'>Es ist ein Fehler aufgetreten!</div>";
            }
        }
        ?>
    </div>

    <div class="header">
        <a href="../index.php">
            <h2 class="logo">SMANGO
        </a>
        <img style="opacity: 0.3;" src="../img/undraw_biking_kc4f.svg" alt="a" /></h1>

        <p class="logo__text">Es ist etwas kaputt gegangen? Trage hier die Daten ein</p>


        <input type="checkbox" id="chk">
        <label for="chk" class="show-menu-btn">
            <i class="fas fa-ellipsis-h"></i>
        </label>

        <ul class="menu">
            <a href="../adminpanel/index.php">Ihr Konto</a>
            <a href="../gallery.php">Gallerie</a>
            <a href="managment.php">Verwaltung</a>
            <a href="repair.php">Reparatur</a>
            <a href="../inc/logout.inc.php">Ausloggen</a>
            <label for="chk" class="hide-menu-btn">
                <i class="fas fa-times"></i>
            </label>
        </ul>
    </div>
    <div class="datenschutz__impressum">
        <ul>
            <li>
                <a href="../impressum.php">Impressum</a>
            </li>
            <li>
                <a href="../privacy.php">Datenschutz</a>
            </li>
        </ul>
    </div>


    <footer><i class="far fa-copyright"> Copyright 2021</i></footer>

    <div class="center">
        <section class="input__form">
            <h1>Reparatur</h1>
            <form action="../inc/repair.inc.php" method="POST">
                <div class="text__field">
                    <span></span>
                    <label class="repair__text__label" style="margin-top: -25px;">Bike</label>
                    <?php
                    echo '<select name="repair__bike__id"> id ="repair__bike"';
                    $query = $conn->query("SELECT name,gestellnummer FROM gerät");
                    while ($row = $query->fetch_assoc()) {
                        echo "<option name='repair__bike__id' value='" . $row['gestellnummer'] . "'>" . $row['name'] . " - " . $row['gestellnummer'] . "</option>";
                    }
                    echo "<span></span>";
                    echo "</select> <br>";
                    ?>
                </div>

                <div class="text__field">
                    <input type="datetime-local" name="datetime" required>
                    <span></span>
                    <label style="margin-top: -18px;">Datum</label>
                </div>
                <div class="text__field">
                    <input type="text" name="description" required>
                    <span></span>
                    <label>Beschreibung</label>
                </div>
                <input type="submit" class="repair__btn" id="signup_submit" name="submit" value="Reparatur eintragen">
            </form>
        </section>
    </div>

</body>

</html>