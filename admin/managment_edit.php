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


$id = $_POST['id'];

$telephone = $_POST['telefonnummer'];
$street = $_POST['straße'];
$postalcode = $_POST['plz'];
$role_id = $_POST['role_id'];



$sql = "UPDATE kunde SET ";

if ($telephone != null) {
    $sql .= "telefonnummer = '$telephone',";
}
if ($street != null) {
    $sql .= " straße = '$street'";
}
if ($postalcode != null) {
    $sql .= ", plz = '$postalcode'";
}
if ($role_id != null) {
    $sql .= ", role_id = '$role_id' ";
}

$sql .= "WHERE kunde_id = '$id'";

print($sql);

$stmt = $conn->query($sql);
