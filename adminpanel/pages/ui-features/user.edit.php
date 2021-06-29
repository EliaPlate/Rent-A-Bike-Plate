<?php
session_start();
include_once '../../../inc/db.inc.php';
include_once '../../../inc/functions.inc.php';
?>

<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../../vendors/feather/feather.css">
  <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../../vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="../../js/select.dataTables.min.css">
  <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
  <link rel="stylesheet" href="edit.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
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

      <div class="errors">

        <?php

        if (isset($_GET['error'])) {
          if ($_GET['error'] == "FIRSTNAME_LONG") {
            echo "<div id='error__input'>Der Vorname kann nicht länger als 10 Zeichen sein!</div>";
          } elseif ($_GET['error'] == "LASTNAME_LONG") {
            echo "<div id='error__input'>Der Nachname kann nicht länger als 10 Zeichen sein!</div>";
          } elseif ($_GET['error'] == "INVALID_EMAIL") {
            echo "<div id='error__input'>Geben Sie bitte eine gültige EMail an!</div>";
          } elseif ($_GET['error'] == "PASSWORD_SHORT") {
            echo "<div id='error__input'>Bitte wählen Sie ein Passwort mit einer Länge von mindestens 6 Zeichen</div>";
          }
        }

        ?>
      </div>
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
                  <h3 class="font-weight-bold">Ihre persönlichen Daten</h3>
                  <h6>Verwalten Sie hier ihre persönlichen Daten. Tipp: Geben Sie niemals Ihre persönlichen Daten weiter</h6>
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

          <div class="row">
            <div class="col-md-6 mb-4 stretch-card transparent">
              <div class="card card-dark-blue" style="background: linear-gradient(45deg, #4747A1, #313170);">
                <div class="card-body">
                  <p class="mb-4" style="font-size: 25px; text-align: center; font-family: monospace;">Vorname: <?php echo getUser($conn, $_SESSION['userid'], null, null, null)['Vorname'] ?></p>
                  <form action="user.edit.inc.php" method="POST">
                    <div class="user__edit__container">
                      <input type="text" id="user__edit__input" name="firstname__value" placeholder="Neuer Vorname" onblur="this.placeholder = 'Neuer Vorname'" onfocus="this.placeholder = ''">
                    </div>
                    <input id="user__edit__submit" type="submit" value="Vorname ändern">
                  </form>
                </div>
              </div>
            </div>

            <div class="col-md-6 mb-4 stretch-card transparent">
              <div class="card card-dark-blue" style="background: linear-gradient(45deg, #4747A1, #313170);">
                <div class="card-body">
                  <p class="mb-4" style="font-size: 25px; text-align: center; font-family: monospace;">Nachname: <?php echo getUser($conn, $_SESSION['userid'], null, null, null)['Nachname'] ?></p>
                  <form action="user.edit.inc.php" method="POST">
                    <div class="user__edit__container">
                      <input type="text" id="user__edit__input" name="lastname__value" placeholder="Neuer Nachname" onblur="this.placeholder = 'Neuer Nachname'" onfocus="this.placeholder = ''">
                    </div>
                    <input id="user__edit__submit" type="submit" value="Nachname ändern">
                  </form>
                </div>
              </div>
            </div>

            <div class="col-md-6 mb-4 stretch-card transparent">
              <div class="card card-dark-blue" style="background: linear-gradient(45deg, #4747A1, #313170);">
                <div class="card-body">
                  <p class="mb-4" style="font-size: 25px; text-align: center; font-family: monospace;">Telefonnummer: <?php echo getUser($conn, $_SESSION['userid'], null, null, null)['Telefonnummer'] ?></p>
                  <form action="user.edit.inc.php" method="POST">
                    <div class="user__edit__container">
                      <input type="text" id="user__edit__input" name="telephone__value" placeholder="Neue Telefonnummer" onblur="this.placeholder = 'Neue Telefonnummer'" onfocus="this.placeholder = ''">
                    </div>
                    <input id="user__edit__submit" type="submit" value="Telefonnummer ändern">
                  </form>
                </div>
              </div>
            </div>

            <div class="col-md-6 mb-4 stretch-card transparent">
              <div class="card card-dark-blue" style="background: linear-gradient(45deg, #4747A1, #313170);">
                <div class="card-body">
                  <p class="mb-4" style="font-size: 25px; text-align: center; font-family: monospace;">EMail: <?php echo getUser($conn, $_SESSION['userid'], null, null, null)['Email'] ?></p>
                  <form action="user.edit.inc.php" method="POST">
                    <div class="user__edit__container">
                      <input type="text" id="user__edit__input" name="email__value" placeholder="Neue EMail" onblur="this.placeholder = 'Neue EMail'" onfocus="this.placeholder = ''">
                    </div>
                    <input id="user__edit__submit" type="submit" value="EMail ändern">
                  </form>
                </div>
              </div>
            </div>

            <div class="col-md-6 mb-4 stretch-card transparent">
              <div class="card card-dark-blue" style="background: linear-gradient(45deg, #4747A1, #313170);">
                <div class="card-body">
                  <p class="mb-4" style="font-size: 25px; text-align: center; font-family: monospace;">Neues Passwort:</p>
                  <form action="user.edit.inc.php" method="POST">
                    <div class="user__edit__container">
                      <input type="text" id="user__edit__input" name="password__value" placeholder="Neues Passwort" onblur="this.placeholder = 'Neues Passwort'" onfocus="this.placeholder = ''">
                    </div>
                    <input id="user__edit__submit" type="submit" value="Passwort ändern">
                  </form>
                </div>
              </div>
            </div>

            <div class="col-md-6 mb-4 stretch-card transparent">
              <div class="card card-dark-blue" style="background: linear-gradient(45deg, #4747A1, #313170);">
                <div class="card-body">
                  <p class="mb-4" style="font-size: 25px; text-align: center; font-family: monospace;">Straße: <?php echo getUser($conn, $_SESSION['userid'], null, null, null)['Straße'] ?></p>
                  <form action="user.edit.inc.php" method="POST">
                    <div class="user__edit__container">
                      <input type="text" id="user__edit__input" name="street__value" placeholder="Neue Straße" onblur="this.placeholder = 'Neue Straße'" onfocus="this.placeholder = ''">
                    </div>
                    <input id="user__edit__submit" type="submit" value="Straße ändern">
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-4 stretch-card transparent">
              <div class="card card-dark-blue" style="background: linear-gradient(45deg, #4747A1, #313170);">
                <div class="card-body">
                  <p class="mb-4" style="font-size: 25px; text-align: center; font-family: monospace;">Wohnort: <?php echo getTownFromId($conn, getUser($conn, $_SESSION['userid'], null, null, null)['PLZ'])['Name'] ?></p>

                  <form action="user.edit.inc.php" method="POST">
                    <div class="user__edit__container">
                      <div class="text__field">
                        <?php
                        echo '<select  name="town__value">';
                        $query = $conn->query("SELECT Name FROM ort");
                        while ($row = $query->fetch_assoc()) {
                          echo "<option value='" . $row['Name'] . "'>" . $row['Name'] . "</option>";
                        }
                        echo "</select>";
                        ?>
                        <input id="user__edit__submit" type="submit" value="Wohnort ändern">
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
  </div>
  </div>

  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/dashboard.js"></script>
  <script src="../../js/Chart.roundedBarCharts.js"></script>
</body>

</html>