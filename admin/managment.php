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
    <title>Verwaltung</title>
</head>

<body>
    <?php

    if (isset($_POST) and !empty($_POST)) {

        if (array_key_exists('submit_one', $_POST)) {
    ?>
            <script>
                window.id = '<?= $_POST['id'] ?>';
                window.vorname = null;
                window.nachname = null;
                window.email = null;


                if ('<?= $_POST['firstname'] ?>' != null) {
                    window.vorname = '<?= $_POST['firstname'] ?>';
                }

                if ('<?= $_POST['lastname'] ?>' != null) {
                    window.nachname = '<?= $_POST['lastname'] ?>';
                }

                if ('<?= $_POST['email'] ?>' != null) {
                    window.email = '<?= $_POST['email'] ?>';
                }

                $.ajax({
                    type: "POST",
                    url: "managment_load.php",
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
                                $.ajax({
                                    type: "POST",
                                    url: "managment_delete.php",
                                    data: {
                                        id: parsed[0]["id"],
                                    },
                                    success: function() {
                                        Swal.fire({
                                            position: 'center',
                                            titleText: 'Benutzer: ' + parsed[0]["vorname"] + " " + parsed[0]["nachname"] + " wurde gelöscht.",
                                            showConfirmButton: true,
                                        })
                                    },
                                    error: function() {
                                        Swal.fire({
                                            position: 'center',
                                            icon: "error",
                                            titleText: 'Es ist leider ein Fehler aufgetreten! :/',
                                            showConfirmButton: true,
                                        })
                                    },
                                })
                                break;
                            case false:

                                Swal.fire({
                                    position: 'center',
                                    icon: "error",
                                    titleText: 'Der Benutzer konnte nicht gefunden werden!',
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
                window.id = '<?= $_POST['id'] ?>';
                window.telephone = null;
                window.street = null;
                window.town = null;
                window.role = null;


                if ('<?= $_POST['telephone'] ?>' != null) {
                    window.telephone = '<?= $_POST['telephone'] ?>';
                }

                if ('<?= $_POST['street'] ?>' != null) {
                    window.street = '<?= $_POST['street'] ?>';
                }

                if ('<?= $_POST['postalcode'] ?>' != null) {
                    window.town = '<?= $_POST['postalcode'] ?>';
                }

                if ('<?= $_POST['role_id'] ?>' != null) {
                    window.role = '<?= $_POST['role_id'] ?>';
                }

                $.ajax({
                    type: "POST",
                    url: "managment_load.php",
                    data: {
                        id: window.id,
                        telephone: window.telephone,
                        street: window.street,
                        town: window.town,
                        role: window.role,
                        key: 1,
                    },
                    success: function(dataArray) {
                        console.log(dataArray);
                        const parsed = JSON.parse(dataArray);

                        console.log(parsed);

                        switch (parsed.length > 0) {
                            case true:
                                $.ajax({
                                    type: "POST",
                                    url: "managment_edit.php",
                                    data: {
                                        id: parsed[0]["id"],
                                        telefonnummer: telephone,
                                        straße: street,
                                        plz: town,
                                        role_id: role
                                    },
                                    success: function() {
                                        Swal.fire({
                                            position: 'center',
                                            titleText: 'Benutzer: ' + parsed[0]["vorname"] + " " + parsed[0]["nachname"] + " wurde bearbeitet.",
                                            showConfirmButton: true,
                                        })
                                    },
                                    error: function() {
                                        Swal.fire({
                                            position: 'center',
                                            icon: "error",
                                            titleText: 'Es ist leider ein Fehler aufgetreten! :/',
                                            showConfirmButton: true,
                                        })
                                    },
                                })
                                break;
                            case false:

                                Swal.fire({
                                    position: 'center',
                                    icon: "error",
                                    titleText: 'Der Benutzer konnte nicht gefunden werden!',
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
        <!-- <p class="logo__text" style="margin-left: 50px;">Benutzerverwaltung war noch nie so einfach!</p> -->


        <input type="checkbox" id="chk">
        <label for="chk" class="show-menu-btn">
            <i class="fas fa-ellipsis-h"></i>
        </label>

        <ul class="menu">

            <a style="font-weight: 500;" href="../adminpanel/index.php">Ihr Konto</a>
            <a style="font-weight: 500;" href="../gallery.php">Gallerie</a>
            <a style="font-weight: 500;" href="managment.php">Verwaltung</a>
            <a style="font-weight: 500;" href="repair.php">Reparatur</a>
            <a style="font-weight: 500;" href="../inc/logout.inc.php">Ausloggen</a>
            <label for="chk" class="hide-menu-btn">
                <i class="fas fa-times"></i>
            </label>
        </ul>

    </div>


    <div class="center">
        <section class="input__form">
            <h1>Verwaltung</h1>
            <div class="slides__controls">
                <input type="radio" name="slider" id="login" checked>
                <input type="radio" name="slider" id="signup">
                <label for="login" class="slide login">Löschen</label>
                <label for="signup" class="slide signup">Bearbeiten</label>
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
                <input type="submit" class="repair__btn" id="signup_submit" name="submit_one" value="Löschvorgang starten">
            </form>
        </section>
    </div>

    <div class="center_two" id="center_two">
        <section class="input__form">
            <form action="" method="POST" class="management_two">
                <div class="text__field">
                    <input type="number" name="id" required>
                    <span></span>
                    <label>Kunden ID (Verpflichtend)</label>
                </div>
                <div class="text__field__edited">
                    <input type="text" name="telephone" class="custom__design">
                    <span></span>
                    <label>Neue Telefonnummer (Optional)</label>
                </div>
                <div class="text__field__edited">
                    <input type="text" name="street" class="custom__design">
                    <span></span>
                    <label>Neue Straße (Optional)</label>
                </div>
                <div class="text__field">
                    <span></span>
                    <label style="margin-top: -25px;">Neuer Ort (Optional)</label>
                    <?php
                    echo '<select class="dropdown_list" name="postalcode" id="managment__dropdown">';
                    $query = $conn->query("SELECT name,plz FROM ort");
                    echo "<option name='postalcode' value='" . null . "'>" . "Nicht verändern" . "</option>";
                    while ($row = $query->fetch_assoc()) {
                        echo "<option  name='postalcode' value='" . $row['plz'] . "'>" . $row['name'] . "</option>";
                    }
                    echo "<span></span>";
                    echo "</select> <br>";
                    ?>
                </div>
                <div class="text__field">
                    <span></span>
                    <label style="margin-top: -25px;">Neuer Rolle (Optional)</label>
                    <?php
                    echo '<select class="dropdown_list" name="role_id" id="managment__role__dropdown">';
                    $query = $conn->query("SELECT name,role_id FROM role");
                    echo "<option  name='role_id' value='" . null . "'>" . "Nicht verändern" . "</option>";
                    while ($row = $query->fetch_assoc()) {
                        echo "<option  name='role_id' value='" . $row['role_id'] . "'>" . $row['name'] . "</option>";
                    }
                    echo "<span></span>";
                    echo "</select> <br>";
                    ?>
                </div>
                <input type="submit" class="btn" id="signup_submit_2" name="submit_two" value="Bearbeitungsvorgang starten">
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
<script src="../javascript/managment.js"></script>
<script src="../javascript/loginHandler.js"></script>

</html>