<?php

session_start();

include_once '../../../inc/db.inc.php';
include_once '../../../inc/functions.inc.php';

$data = array();
$id = $_SESSION['userid'];

$query = "SELECT * FROM ausleihe WHERE Kunde_id = '$id'";
$statement = $conn->query($query);
$result = $statement->fetch_all(MYSQLI_ASSOC);

foreach ($result as $row) {
    $data[] = array(
        'title'   => "Ausleihe Nr.: " . $row["Ausleihe_id"],
        'id'   => $row["Ausleihe_id"],
        'start'   => $row["Start"],
        'end'   => $row["Ende"],
        'tarif'   => getTarif($conn, $row["Tarif_id"])['Name'],
        'klasse'   => getClass($conn, $row["Klasse_id"])['Art'],
        'gerät'   => getDevice($conn, $row["Gestellnummer"])['name'],
        'kunde_id' => $row['Kunde_id'],
    );
}

echo json_encode($data);
