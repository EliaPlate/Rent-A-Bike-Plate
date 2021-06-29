<html lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ausleihstation suchen</title>
    <link rel="stylesheet" href="edit.css">
    <link rel="stylesheet" href="../../vendors/feather/feather.css">
    <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="../../js/select.dataTables.min.css">
    <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

</html>

<body>
    <div class="container-scroller">
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="../../index.php">Smango</a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize" style="margin-right: 100%;">
                    <span class="icon-menu"></span>
                </button>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../../index.php">
                            <i class="fas fa-home menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                            <i class="fas fa-truck-moving menu-icon"></i>
                            <span class="menu-title">Buchungen</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="rent.all.php">Alle</a></li>
                                <li class="nav-item"> <a class="nav-link" href="rent.all.active.php">Aktive</a></li>
                                <li class="nav-item"> <a class="nav-link" href="rent.all.over.php">Veraltete</a></li>
                                <li class="nav-item"> <a class="nav-link" href="rent.cancel.php">Kündigen</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                            <i class="fas fa-database menu-icon"></i>
                            <span class="menu-title">Benutzer</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="form-elements">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="user.edit.php">Benutzerdaten</a></li>
                                <li class="nav-item"><a class="nav-link" href="user.delete.php">Konto löschen</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                            <i class="fas fa-tasks menu-icon"></i>
                            <span class="menu-title">Verwaltung</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="charts">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="all.members.php">Alle Kunden</a></li>
                                <li class="nav-item"> <a class="nav-link" href="all.members.no.admins.php">Kunden o. Admin</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                            <i class="fas fa-search menu-icon"></i>
                            <span class="menu-title">Suche</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="icons">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="search.repair.php">Reparatur</a></li>
                                <li class="nav-item"> <a class="nav-link" href="search.device.php">Gerät</a></li>
                                <li class="nav-item"> <a class="nav-link" href="search.member.php">Kunde</a></li>
                                <li class="nav-item"> <a class="nav-link" href="search.place.php">Ausleihstation</a></li>
                            </ul>
                        </div>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                            <i class="fas fa-bicycle menu-icon"></i>
                            <span class="menu-title">Mieten</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="auth">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="rent.calendar.php">Termine</a></li>
                                <li class="nav-item"> <a class="nav-link" href="rent.php">Bike mieten</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
                            <i class="fas fa-globe-europe menu-icon"></i>
                            <span class="menu-title">Google Maps</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="error">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="google.maps.php">Ausleihstation</a></li>
                            </ul>
                        </div>
                    </li>

                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold">Ausleihstation suchen</h3>
                                    <h6>Wählen Sie eine Ausleihstation im Dropdown aus, um den Standort der Ausleihstation zu finden.</h6>
                                </div>
                                <div class="col-12 col-xl-4">
                                    <div class="justify-content-end d-flex">
                                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php

                    include_once '../../../inc/db.inc.php';

                    if (isset($_POST['submit_address'])) {
                        $entry = $_POST['submit_address'];
                        $sql = "SELECT PLZ FROM ausleihstation WHERE Straße = '$entry'";
                        $query = $conn->query($sql);
                        $plz = $query->fetch_assoc()['PLZ'];
                    ?>

                        <iframe style="border-radius: 35px;" src="https://maps.google.com/maps?q=<?php echo $_POST['submit_address'] . $plz; ?>&output=embed" width="100%" height="500px"></iframe>
                    <?php

                    }


                    ?>

                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue" style="background: linear-gradient(45deg, #4747A1, #313170); margin-top: 50px; margin-left: 50%;">
                            <div class="card-body">
                                <p class="mb-4" style="font-size: 25px; text-align: center; font-family: monospace;">Straße der Ausleihstation</p>

                                <form method="POST">
                                    <div class="user__edit__container">
                                        <div class="text__field">
                                            <?php
                                            echo '<select  name="submit_address">';
                                            $query = $conn->query("SELECT Straße FROM ausleihstation");
                                            while ($row = $query->fetch_assoc()) {
                                                echo "<option name='submit_address' value='" . $row['Straße'] . "'>" . $row['Straße'] . "</option>";
                                            }
                                            echo "</select>";
                                            ?>
                                            <input id="user__edit__submit" type="submit" value="Suche starten">
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="../../vendors/js/vendor.bundle.base.js"></script>
    <script src="../../js/off-canvas.js"></script>
    <script src="../../js/hoverable-collapse.js"></script>
    <script src="../../js/template.js"></script>
    <script src="../../js/dashboard.js"></script>
    <script src="../../js/Chart.roundedBarCharts.js"></script>
</body>