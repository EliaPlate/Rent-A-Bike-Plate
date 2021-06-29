<?php

include_once '../../../inc/db.inc.php';
include_once '../../../inc/functions.inc.php';
$data = array();

if ($_POST['file_id'] == 0) {
    $statementTarif = $conn->query("SELECT Name FROM tarif");
    $resultTarif = $statementTarif->fetch_all(MYSQLI_ASSOC);
    foreach ($resultTarif as $row) {
        $data[] = array(
            'name' => $row['Name']
        );
    }
} else if ($_POST['file_id'] == 1) {
    $statement = $conn->query("SELECT Art FROM klasse");
    $result = $statement->fetch_all(MYSQLI_ASSOC);

    foreach ($result as $row) {
        $data[] = array(
            'art'   => $row["Art"]
        );
    }
} else if ($_POST['file_id'] == 2) {
    $className = $_POST['className'];


    $classId = getClassFromName($conn, $className)['Klasse_id'];

    $statement = $conn->query("SELECT name FROM gerät WHERE Klasse_id = '$classId'");
    $result = $statement->fetch_all(MYSQLI_ASSOC);

    foreach ($result as $row) {
        $data[] = array(
            'name'   => $row["name"]
        );
    }
}




echo json_encode($data);
