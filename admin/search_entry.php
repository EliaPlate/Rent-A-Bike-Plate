<?php
session_start();
include_once '../inc/functions.inc.php';
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Suchen..</title>
</head>

<body>
    <?php

    if (isset($_POST) and !empty($_POST)) {

        if (array_key_exists('submit_one', $_POST)) {
    ?>
            <script>
                window.id = '<?= $_POST['id'] ?>';
                window.vorname = '<?= $_POST['firstname'] ?>';
                window.nachname = '<?= $_POST['lastname'] ?>';
                window.email = '<?= $_POST['email'] ?>';
                $.ajax({
                    type: "POST",
                    url: "search_load.php",
                    data: {
                        id: window.id,
                        vorname: window.vorname,
                        nachname: window.nachname,
                        email: window.email,
                        key: 0,
                    },
                    success: function(dataArray) {
                        const parsed = JSON.parse(dataArray);

                        console.log(parsed);

                        switch (parsed.length > 0) {
                            case true:
                                Swal.fire({
                                    position: 'center',
                                    titleText: 'Kunde: ' + parsed[0]["vorname"] + " " + parsed[0]["nachname"],
                                    html: "Kunden Nummer: " + parsed[0]["kunde_id"] + "<br> Vorname: " + parsed[0]['vorname'] + "<br> Nachname: " + parsed[0]['nachname'] + "<br> Telefonnummer: " + parsed[0]['telefonnummer'] + "<br> EMail: " + parsed[0]['email'],
                                    showConfirmButton: true,
                                })
                                break;
                            case false:

                                Swal.fire({
                                    position: 'center',
                                    icon: "error",
                                    titleText: 'Der Kunde konnte nicht gefunden werden!',
                                    showConfirmButton: true,
                                })
                                break;

                            default:
                                break;
                        }

                    }
                })
            </script>
        <?php
        } else if (array_key_exists('submit_two', $_POST)) {
        ?>
            <script>
                window.id = '<?= $_POST['reparatur_id'] ?>';
                $.ajax({
                    type: "POST",
                    url: "search_load.php",
                    data: {
                        id: window.id,
                        key: 1,
                    },
                    success: function(dataArray) {
                        const parsed = JSON.parse(dataArray);

                        console.log(parsed);

                        switch (parsed.length > 0) {
                            case true:
                                Swal.fire({
                                    position: 'center',
                                    titleText: 'Es wurde folgende Reparatur gefunden:',
                                    html: "Datum: " + parsed[0]["datum"] + "<br> Beschreibung: " + parsed[0]["beschreibung"] + "<br> Gestellnummer: " + parsed[0]["gestellnummer"],
                                    showConfirmButton: true,
                                })
                                break;
                            case false:

                                Swal.fire({
                                    position: 'center',
                                    icon: "error",
                                    titleText: 'Es konnte keine Reparatur gefunden werden!',
                                    showConfirmButton: true,
                                })
                                break;

                            default:
                                break;
                        }

                    }
                })
            </script>
    <?php
        }
    }

    ?>

    <div class="header">
        <a href="../index.php">
            <h2 class="logo">SMANGO
        </a>
        <img style="opacity: 0.3;" src="../img/undraw_biking_kc4f.svg" alt="a" /></h1>
        <p class="logo__text">Ermöglich deine Fahrradtour mit deinem gemieteten E-Bike</p>


        <input type="checkbox" id="chk">
        <label for="chk" class="show-menu-btn">
            <i class="fas fa-ellipsis-h"></i>
        </label>


        <ul class="menu">
            <a style="font-weight: 500;" href="../gallery.php">Gallerie</a>
            <a style="font-weight: 500;" href="managment.php">Verwaltung</a>
            <a style="font-weight: 500;" href="search_entry.php">Suche</a>
            <a style="font-weight: 500;" href="repair.php">Reparatur</a>
            <a style="font-weight: 500;" href="../inc/logout.inc.php">Ausloggen</a>
            <label for="chk" class="hide-menu-btn">
                <i class="fas fa-times"></i>
            </label>
        </ul>
    </div>


    <div class="center">
        <section class="input__form">
            <h1>Suche</h1>
            <div class="slides__controls">
                <input type="radio" name="slider" id="login" checked>
                <input type="radio" name="slider" id="signup">
                <label for="login" class="slide login">Benutzer</label>
                <label for="signup" class="slide signup">Reparatur</label>
                <div class="slide-tab"></div>
            </div>
            <form action="" method="POST" id="center">
                <div class="text__field">
                    <input type="number" name="id" required>
                    <span></span>
                    <label>Kunden ID (Verpflichtend)</label>
                </div>
                <div class="text__field__edited">
                    <input type="text" name="firstname" class="custom__design">
                    <span></span>
                    <label>Vorname (Optional)</label>
                </div>
                <div class="text__field__edited">
                    <input type="text" name="lastname" class="custom__design">
                    <span></span>
                    <label>Nachname (Optional)</label>
                </div>
                <div class="text__field__edited">
                    <input type="text" name="email" class="custom__design">
                    <span></span>
                    <label>Email (Optional)</label>
                </div>
                <input type="submit" class="repair__btn" id="signup_submit" name="submit_one" value="Suche starten">
            </form>
        </section>
    </div>

    <div class="center_two" id="center_two">
        <section class="input__form">
            <form action="" method="POST" class="search__entry_repair">
                <div class="text__field">
                    <input type="number" name="reparatur_id" required>
                    <span></span>
                    <label>Reparatur ID (Verpflichtend)</label>
                </div>
                <input type="submit" class="btn" id="signup_submit_2" name="submit_two" value="Suche starten">
            </form>
        </section>
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

</body>
<script src="../javascript/search.js"></script>
<script src="../javascript/loginHandler.js"></script>

</html>