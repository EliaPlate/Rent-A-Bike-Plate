<?php

include_once '../../../inc/db.inc.php';
include_once '../../../inc/functions.inc.php';

if (array_key_exists('station__id_value', $_POST)) {

    $ausleiheId = $_POST['station__id_value'];

    if (empty($ausleiheId)) {
        header("location: rent.cancel.php?errors=SELECT_TERMIN");
        exit();
    }
    if (!isset($_POST['rent__box__value'])) {
        header("location: rent.cancel.php?errors=SELECT_BOX");
        exit();
    }

    $stmt = $conn->prepare("DELETE FROM ausleihe WHERE Ausleihe_id = '$ausleiheId'");
    $stmt->execute();
    $stmt->close();
    header("location: rent.cancel.php?errors=NONE");
    exit();
}
