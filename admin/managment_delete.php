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


$stmt = $conn->prepare("DELETE FROM kunde WHERE kunde_id = ?");
$stmt->bind_param("i", $id);

$stmt->execute();
$stmt->close();
