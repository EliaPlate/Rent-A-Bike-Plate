<?php
session_start();
include_once '../../../inc/db.inc.php';
include_once '../../../inc/functions.inc.php';
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rechnung</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../../vendors/feather/feather.css">
    <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="../../js/select.dataTables.min.css">
    <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

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

            <?php
            $start = explode(',', $_POST['data'])[2];
            if ($start == '') {
                header("location: rent.php?error=INVALID_START");
            }
            ?>

        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>
            <div id="right-sidebar" class="settings-panel">
                <i class="settings-close ti-close"></i>
                <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
                    </li>
                </ul>
            </div>
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
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
                                <li class="nav-item"><a class="nav-link" href="user.delete.php">Kündigen</a></li>
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
                        <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                            <i class="fas fa-search menu-icon"></i>
                            <span class="menu-title">Suche</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="icons">
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
                                    <h3 class="font-weight-bold">Rechnung</h3>
                                    <h6>Hier finden Sie nochmal die Rechnung die Sie für das Mieten einmalig bezahlen müssen.</h6>
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



                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body p-0">

                                        <hr class="my-5">

                                        <div class="row pb-5 p-5">
                                            <div class="col-md-6">
                                                <p class="font-weight-bold mb-4">Anschrift Unternehmen</p>
                                                <p class="mb-1">Elia Plate</p>
                                                <p>Smango</p>
                                                <p class="mb-1">Gruenauer Straße 69</p>
                                                <p class="mb-1">Berlin, Germany</p>
                                                <p class="mb-1">6781</p>
                                            </div>

                                            <div class="col-md-6 text-right">
                                                <p class="font-weight-bold mb-4">Zahlungsinformationen</p>
                                                <p class="mb-1"><span class="text-muted">Rechnung #</span><?php echo rand(187, 97895) ?></p>
                                                <p class="mb-1"><span class="text-muted">Mehrwertsteuer: </span> 9%</p>
                                                <p class="mb-1"><span class="text-muted">Umsatzsteuer: </span> DE<?php echo rand(100000000, 999999999) ?></p>
                                                <p class="mb-1"><span class="text-muted">Zahlungsart: </span> Paypal</p>
                                                <p class="mb-1"><span class="text-muted">Ausleihe Start: </span> <?php echo date("d.m.Y H:i:s", strtotime(explode(',', $_POST['data'])[2])) ?></p>
                                                <p class="mb-1"><span class="text-muted">An: </span> <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'] ?></p>
                                            </div>
                                        </div>

                                        <div class="row p-5">
                                            <div class="col-md-12">
                                                <form action="bill.inc.php" method="POST">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th class="border-0 text-uppercase small font-weight-bold">ID</th>
                                                                <th class="border-0 text-uppercase small font-weight-bold">Art</th>
                                                                <th class="border-0 text-uppercase small font-weight-bold">Tarif</th>
                                                                <th class="border-0 text-uppercase small font-weight-bold">Name</th>
                                                                <th class="border-0 text-uppercase small font-weight-bold">Preis</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td> <?php echo rand(187, 97895) ?></td>
                                                                <td><input type="hidden" name="class" value="<?php echo explode(',', $_POST['data'])[0]  ?>"> <?php echo explode(',', $_POST['data'])[0]  ?></td>
                                                                <td><input type="hidden" name="tarif" value="<?php echo explode(',', $_POST['data'])[1]  ?>"> <?php echo explode(',', $_POST['data'])[1]  ?></td>
                                                                <td><input type="hidden" name="device" value="<?php echo explode(',', $_POST['data'])[3]  ?>"> <?php echo explode(',', $_POST['data'])[3]  ?></td>
                                                                <input type="hidden" name="start" value="<?php echo explode(',', $_POST['data'])[2]  ?>">
                                                                <td><?php
                                                                    $className = explode(',', $_POST['data'])[0];
                                                                    $tarifName = explode(',', $_POST['data'])[1];
                                                                    $class = getClassFromName($conn, $className);
                                                                    $tarif = getTarifFromName($conn, $tarifName);
                                                                    $price = ($class['Preis'] * 0.05) + $tarif['Preis'];
                                                                    echo $price . "€";
                                                                    ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="h2 font-weight-light" style="font-size: 20px;"><input type="submit" value="Jetzt Mieten" style="border-radius: 35px; background: none; color: white; padding: 10px; position: absolute; right: 0; bottom: -200px;"></div>
                                                </form>
                                            </div>
                                        </div>



                                        <div class="d-flex flex-row-reverse bg-dark text-white p-4">

                                            <div class="py-3 px-5 text-right">
                                                <div class="mb-2">Endpreis</div>
                                                <div class="h2 font-weight-light"><?php
                                                                                    $className = explode(',', $_POST['data'])[0];
                                                                                    $tarifName = explode(',', $_POST['data'])[1];
                                                                                    $class = getClassFromName($conn, $className);
                                                                                    $tarif = getTarifFromName($conn, $tarifName);
                                                                                    $price = ($class['Preis'] * 0.05) + $tarif['Preis'];
                                                                                    $price += $price * 0.09;
                                                                                    echo $price . "€";
                                                                                    ?></div>
                                            </div>

                                            <div class="py-3 px-5 text-right">
                                                <div class="mb-2">Ohne Mehrwertsteuer</div>
                                                <div class="h2 font-weight-light"><?php

                                                                                    $className = explode(',', $_POST['data'])[0];
                                                                                    $tarifName = explode(',', $_POST['data'])[1];
                                                                                    $class = getClassFromName($conn, $className);
                                                                                    $tarif = getTarifFromName($conn, $tarifName);
                                                                                    $price = ($class['Preis'] * 0.05) + $tarif['Preis'];
                                                                                    echo $price . "€"; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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