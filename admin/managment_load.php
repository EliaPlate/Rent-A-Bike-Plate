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

    $sql = "SELECT * FROM kunde WHERE (kunde_id = '$id' ";

    if ($vorname != null) {
        $sql .= "OR vorname = '$vorname'";
    }
    if ($nachname != null) {
        $sql .= " OR nachname = '$nachname'";
    }
    if ($email != null) {
        $sql .= " OR email = '$email'";
    }


    $sql .= ")";

    $statement = $conn->query($sql);
    $result = $statement->fetch_all(MYSQLI_ASSOC);

    foreach ($result as $row) {
        $data[] = array(
            "id" => $id,
            "vorname" => $row["Vorname"],
            "nachname" => $row["Nachname"],
        );
    }
} else if ($_POST['key'] == 1) {



    $statement = $conn->query("SELECT * FROM kunde WHERE kunde_id = '$id'");
    $result = $statement->fetch_all(MYSQLI_ASSOC);

    foreach ($result as $row) {
        $data[] = array(
            "id" => $id,
            "vorname" => $row["Vorname"],
            "nachname" => $row["Nachname"],
            "telefonnummer" => $row["Telefonnummer"],
            "straße" => $row["Straße"],
            "plz" => $row["PLZ"],
            "role_id" => $row["role_id"],
        );
    }
}
echo json_encode($data);
