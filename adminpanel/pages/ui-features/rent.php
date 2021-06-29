<!DOCTYPE html>
<html lang="de">

<head>
  <title>Bike Mieten</title>



  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/dashboard.js"></script>
  <script src="../../js/Chart.roundedBarCharts.js"></script>

  <link rel="stylesheet" href=".././../../fullcalender.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link rel="stylesheet" href="edit.css">

  <link rel="stylesheet" href="../../vendors/feather/feather.css">
  <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../../vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="../../js/select.dataTables.min.css">
  <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <script src="https://rawgit.com/tempusdominus/bootstrap-4/master/build/js/tempusdominus-bootstrap-4.js"></script>




  <script>
    $(document).ready(function() {
      var calendar = $('#calendar').fullCalendar({
        eventStartEditable: false,
        editable: true,
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        selectable: true,
        selectHelper: true,
        select: function(event) {
          var tarifName = null;
          var start = null;
          var className = null;


          var inputOptionsPromise = new Promise(function(resolve) {
            $.ajax({
              url: "rent.inc.php",
              type: "POST",
              data: {
                file_id: 0
              },
              success: function(dataArray) {
                const parsed = JSON.parse(dataArray);

                var navbar = document.getElementById("sidebar");

                navbar.style.zIndex = 0;

                tarife = []

                for ($i = 0; $i < parsed.length; $i++) {
                  tarife[$i] = parsed[$i]['name'];
                }

                setTimeout(function() {
                  resolve({
                    tarife: tarife
                  })
                })

                Swal.fire({
                  title: "Start / Tarif auswählen",
                  showDenyButton: true,
                  denyButtonText: "Abbrechen",
                  confirmButtonText: "Weiter",
                  input: "select",
                  inputOptions: inputOptionsPromise,
                  html: 'Start: <input type="text" name="payment_day" class="datetimepicker-input swal2-input" autocomplete="off" data-toggle="datetimepicker" data-target="#payment_day" id="payment_day"> <br> Tarif:',
                  onOpen: function() {
                    $('#payment_day').datetimepicker({});
                  },
                  onClose: function() {
                    navbar.style.zIndex = 99999;
                  },
                  preConfirm: function(value) {
                    tarifName = tarife[value];
                    start = $('#payment_day').val();
                    return new Promise((resolve, reject) => {
                      resolve({
                        start: $('#payment_day').val(),
                        tarif_id: value
                      })
                    });
                  }
                }).then((result) => {
                  if (result.isConfirmed) {
                    navbar.style.zIndex = 0;
                    var inputOptionsPromiseTwo = new Promise(function(resolve) {
                      $.ajax({
                        url: "rent.inc.php",
                        type: "POST",
                        data: {
                          file_id: 1
                        },
                        success: function(dataArray) {
                          const parsed = JSON.parse(dataArray);
                          classes = []

                          for ($i = 0; $i < parsed.length; $i++) {
                            classes[$i] = parsed[$i]['art'];
                          }

                          setTimeout(function() {
                            resolve({
                              classes: classes
                            })
                          })

                          Swal.fire({
                            title: "Klassenart auswählen",
                            showDenyButton: true,
                            denyButtonText: "Abbrechen",
                            confirmButtonText: "Weiter",
                            input: "select",
                            inputOptions: inputOptionsPromiseTwo,
                            onClose: function() {
                              navbar.style.zIndex = 99999;
                            },
                          }).then((result) => {
                            if (result.isConfirmed) {
                              className = classes[result.value];
                              navbar.style.zIndex = 0;
                              var inputOptionsPromiseThree = new Promise(function(resolve) {
                                $.ajax({
                                  url: "rent.inc.php",
                                  type: "POST",
                                  data: {
                                    file_id: 2,
                                    className: classes[result.value],
                                  },
                                  success: function(dataArray) {
                                    const parsed = JSON.parse(dataArray);
                                    devices = []

                                    for ($i = 0; $i < parsed.length; $i++) {
                                      devices[$i] = parsed[$i]['name'];
                                    }

                                    setTimeout(function() {
                                      resolve({
                                        devices: devices
                                      })
                                    })

                                    Swal.fire({
                                      title: "Gerät auswählen",
                                      showDenyButton: true,
                                      denyButtonText: "Abbrechen",
                                      confirmButtonText: "Weiter",
                                      input: "select",
                                      inputOptions: inputOptionsPromiseThree,
                                      onClose: function() {
                                        navbar.style.zIndex = 99999;
                                      },
                                    }).then((result) => {
                                      if (result.isConfirmed) {
                                        navbar.style.zIndex = 0;

                                        var deviceName = devices[result.value];

                                        var array = []

                                        array[0] = className;
                                        array[1] = tarifName;
                                        array[2] = start;
                                        array[3] = deviceName;


                                        $.ajax({
                                          type: "POST",
                                          url: "bill.php",
                                          data: {
                                            class: className,
                                            tarif: tarifName,
                                            start: start,
                                            device: deviceName,
                                          },
                                          success: function() {
                                            var form = $('<form action="bill.php" method="post">' +
                                              '<input type="text" name="data" value="' + array + '" />' +
                                              '</form>');
                                            $('body').append(form);
                                            form.submit();
                                          },
                                        });

                                      }
                                    });
                                  },
                                });
                              });
                            }
                          });
                        },
                      });
                    });
                  }
                })
              },
            });
          });
        }
      });
    });
  </script>
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
      if (isset($_GET['error'])) {
        if ($_GET['error'] == "INVALID_START") {
      ?>
          <div style="position: absolute; top: 15px; font-size: 20px; font-family: 'Montserrat'; left: 40%;">Bitte geben Sie einen gültigen Start an.</div>
        <?php
        } elseif ($_GET['error'] == "INSERTFAILED") {
        ?>
          <div style="position: absolute; top: 15px; font-size: 20px; font-family: 'Montserrat'; left: 40%;">Es ist ein Fehler aufgetreten, versuche nochmal.</div>
      <?php
        }
      }
      ?>



      <div class="container">
        <div id="calendar"></div>
      </div>


    </nav>

    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar" style="z-index: 99999;">
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
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>

</body>

</html>