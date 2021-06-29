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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Gallerie</title>
</head>

<body class="gallery__body">
    <div class="header">
        <a href="index.php">
            <h2 class="logo" id="logo">SMANGO
        </a></h2>

        <p class="logo__text" style="margin-left: 70px; margin-bottom: 50px">Finde Sie mehr über unsere Tarife raus!</p>
        <p class="gallery__text__bottom"></p>


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
                <a href="impressum.php">Impressum</a>
            </li>
            <li>
                <a href="privacy.php">Datenschutz</a>
            </li>
        </ul>
    </div>

    <footer><i class="far fa-copyright"> Copyright 2021</i></footer>



    <div class="gallery__container">
        <ul>
            <li>
                <div class="image__container__one">
                    <span>Stunden Tarif</span>
                    <img id="image__one" src='img/istockphoto-665372040-612x612.jpg' />
                    <div class="gallery__title">Unser Stunden Tarif</div>
                    <div class="gallery__text">
                        <p>Sie zahlen 10€ für 1 Stunde. <br> Des Weiteren zahlen Sie 5% einmalig <br> je nach Art.</p>
                    </div>
                    <div class="gallery__rent__link">
                        <a href="rent.php">Jetzt Mieten</a>
                    </div>
                </div>
            </li>
            <li>
                <div class="image__container__two">
                    <span>Tages Tarif</span>
                    <img id="image__two" src='img/istockphoto-1182762582-612x612.jpg' />
                    <div class="gallery__title">Unser Tages Tarif</div>
                    <div class="gallery__text">
                        <p>Sie zahlen 60€ für 1 Tag. <br> Des Weiteren zahlen Sie 5% einmalig <br> je nach Art.</p>
                    </div>
                    <div class="gallery__rent__link">
                        <a href="rent.php">Jetzt Mieten</a>
                    </div>
                </div>
            </li>

            <li>
                <div class="image__container__three">
                    <span>Wochenend Tarif</span>
                    <img id="image__three" src='img/depositphotos_28403563-stock-photo-mountain-bike-athlete.jpg' />
                    <div class="gallery__title">Unser Wochenend Tarif</div>
                    <div class="gallery__text">
                        <p>Sie zahlen 120€ für 1 Wochenende. <br> Des Weiteren zahlen Sie 5% einmalig <br> je nach Art.</p>
                    </div>
                    <div class="gallery__rent__link">
                        <a href="rent.php">Jetzt Mieten</a>
                    </div>
                </div>
            </li>


            <li>
                <div class="image__container__four">
                    <span>Monats tarif</span>
                    <img id="image__four" src='img/Download (1).png' />
                    <div class="gallery__title">Unser Monats Tarif</div>
                    <div class="gallery__text">
                        <p>Sie zahlen 1.200€ für 1 Monat. <br> Des Weiteren zahlen Sie 5% einmalig <br> je nach Art.</p>
                    </div>
                    <div class="gallery__rent__link">
                        <a href="rent.php">Jetzt Mieten</a>
                    </div>
                </div>
            </li>

            <li>
                <div class="image__container__five">
                    <span>Jahres Tarif</span>
                    <img id="image__five" src='img/istockphoto-1185006061-612x612.jpg' />
                    <div class="gallery__title">Unser Jahres Tarif</div>
                    <div class="gallery__text">
                        <p>Sie zahlen 3.600€ für 1 Jahr. <br> Des Weiteren zahlen Sie 5% einmalig <br> je nach Art.</p>
                    </div>
                    <div class="gallery__rent__link">
                        <a href="rent.php">Jetzt Mieten</a>
                    </div>
                </div>
            </li>


        </ul>
    </div>

    <div class="gallery__two__container" style="overflow: visible;">
        <ul>
            <li>
                <span>EBike Turbo S</span>
                <img id="image__one" src='img/istockphoto-1133394357-612x612.jpg' />
            </li>
            <li>
                <span>Mountainbike Pro</span>
                <img id="image__two" src='img/depositphotos_9963690-stock-photo-mtb-downhill.jpg' />
            </li>

            <li>
                <span>Mountainbike Pro²</span>
                <img id="image__three" src='img/7cafef5c27125029428a21161fa17473.jpg' />
            </li>


            <li>
                <span>Scooter Porsch</span>
                <img id="image__four" src='img/young-woman-on-electric-scooter-260nw-1518039665.jpg' />
            </li>

            <li>
                <span>EBike Standard</span>
                <img id="image__five" src='img/BullsSix50_14-spread.jpg' />
            </li>


        </ul>
    </div>

    <script src="javascript/gallery.js"></script>
</body>