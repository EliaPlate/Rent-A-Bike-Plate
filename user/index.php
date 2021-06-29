<?php
session_start();
include_once '../inc/db.inc.php';
include_once '../inc/functions.inc.php';

if (!isset($_SESSION['firstname'])) {
  header("location: ../index.php");
  exit();
  return;
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
  <div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="../index.php">Smango</a>
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
            <a class="nav-link" href="index.php">
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
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/rent.all.php">Alle</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/rent.all.active.php">Aktive</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/rent.all.over.php">Veraltete</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/rent.cancel.php">Kündigen</a></li>
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
                <li class="nav-item"><a class="nav-link" href="pages/ui-features/user.edit.php">Benutzerdaten</a></li>
                <li class="nav-item"><a class="nav-link" href="pages/ui-features/user.delete.php">Konto löschen</a></li>
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
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/rent.calendar.php">Termine</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/rent.php">Bike mieten</a></li>
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
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/google.maps.php">Ausleihstation</a></li>
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
                  <h3 class="font-weight-bold">Hallo <?php echo $_SESSION['firstname'] ?> <?php echo $_SESSION['lastname'] ?></h3>
                  <h6>Hier haben Sie eine Übersicht über Ihr Dashboard</h6>
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
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="../img//undraw_scooter_aia8.svg" alt="people">
                  <div class="weather-info">
                    <div class="d-flex">
                      <div>
                        <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2>
                      </div>
                      <div class="ml-2">
                        <h4 class="location font-weight-normal">Celle</h4>
                        <h6 class="font-weight-normal">Deutschland</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Heutige Buchungen</p>
                      <p class="fs-30 mb-2"><?php echo getCurrentRentFromMember($conn, $_SESSION['userid']) ?></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Gesamtbuchungen</p>
                      <p class="fs-30 mb-2"><?php echo getOverallRentFromMember($conn, $_SESSION['userid']) ?></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Benutzer seit</p>
                      <p class="fs-30 mb-2"><?php
                                            $joined = getUser($conn, $_SESSION['userid'], null, null, null)['joined'];
                                            $joined = date("d-m-Y H:i:s", strtotime($joined));
                                            echo $joined;
                                            ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <p class="card-title">Ihre Buchungen</p>
                <div class="row">
                  <div class="col-12">
                    <div class="table-responsive">
                      <table id="example" class="display expandable-table" style="width:100%">
                        <thead>
                          <tr>
                            <th>Buchungs ID</th>
                            <th>Start</th>
                            <th>Ende</th>
                            <th>Tarif</th>
                            <th>Klasse</th>
                            <th>Gerät</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $id = $_SESSION['userid'];
                          $query = $conn->query("SELECT * FROM ausleihe WHERE Kunde_id = '$id'");
                          while ($row = $query->fetch_assoc()) {
                          ?>
                            <tr style="border-bottom: 1px solid #808080;">

                              <td><?php echo $row['Ausleihe_id'] ?></td>
                              <td><?php echo $row['Start'] ?></td>
                              <td><?php echo $row['Ende'] ?></td>
                              <td><?php echo getTarif($conn, $row['Tarif_id'])['Name'] ?></td>
                              <td><?php echo getClass($conn, $row['Klasse_id'])['Art'] ?></td>
                              <td><?php echo getDevice($conn, $row['Gestellnummer'])['name'] ?></td>

                            </tr>
                          <?php
                          }
                          ?>
                        </tbody>
                      </table>
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

  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
</body>

</html>