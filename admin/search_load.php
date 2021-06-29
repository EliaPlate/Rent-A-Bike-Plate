<?php


session_start();

include_once '../inc/db.inc.php';

include_once '../inc/functions.inc.php';
if (isset($_SESSION)) {
    if (!isAdmin($_SESSION)) {
        header("location: ../error/error_403_page.html");
    }
} else {
    header("location: ../error/error_403_page.html");
}

$data = array();
$id = $_POST['id'];

if ($_POST['key'] == 0) {

    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $email = $_POST['email'];

    $query = "SELECT * FROM kunde WHERE (kunde_id = '$id' OR vorname = '$vorname' OR nachname = '$nachname' OR email = '$email')";
    $statement = $conn->query($query);
    $result = $statement->fetch_all(MYSQLI_ASSOC);

    foreach ($result as $row) {
        $data[] = array(
            "kunde_id" => $row['Kunde_id'],
            "vorname" => $row["Vorname"],
            "nachname" => $row["Nachname"],
            "telefonnummer" => $row["Telefonnummer"],
            "email" => $row["Email"],
            "straße" => $row["Straße"],
            "plz" => $row["PLZ"],
        );
    }
} else if ($_POST['key'] == 1) {

    $query = "SELECT * FROM reparaturen WHERE reperatur_id = '$id'";
    $statement = $conn->query($query);
    $result = $statement->fetch_all(MYSQLI_ASSOC);

    foreach ($result as $row) {
        $data[] = array(
            "id" => $id,
            "datum" => $row["Datum"],
            "beschreibung" => $row["Beschreibung"],
            "gestellnummer" => $row["Gestellnummer"],
        );
    }
}
echo json_encode($data);
