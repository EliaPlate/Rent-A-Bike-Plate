<?php





if (isset($_POST["submit"])) {


    include_once 'db.inc.php';
    include_once 'functions.inc.php';

    $bikeId   = mysqli_real_escape_string($conn, $_POST['repair__bike__id']);
    $datetime   = mysqli_real_escape_string($conn, $_POST['datetime']);
    $description   = mysqli_real_escape_string($conn, $_POST['description']);


    $query = "INSERT INTO reparaturen (Datum, Beschreibung, Gestellnummer) VALUES(?, ?, ?)";
    $statement = $conn->prepare($query);
    $statement->bind_param("ssi", $datetime, $description, $bikeId);
    $statement->execute();

    header("location: ../admin/repair.php?error=none");
} else {
    header("location: ../login.php?error=error");
    exit();
}
