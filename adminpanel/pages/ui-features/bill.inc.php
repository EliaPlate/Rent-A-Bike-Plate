<?php
session_start();

include_once '../../../inc/db.inc.php';
include_once '../../../inc/functions.inc.php';

$className = $_POST['class'];
$tarifName = $_POST['tarif'];
$deviceName = $_POST['device'];
$kundeId = $_SESSION['userid'];
$start = $_POST['start'];
$start = date("Y-m-d H:i:s", strtotime($start));

$startPlaceHolder = new DateTime($start);

if (strcasecmp($tarifName, "stunden") == 0) {
    $end = $startPlaceHolder->add(new DateInterval('P0Y0M0DT1H0M0S'));
} elseif (strcasecmp($tarifName, "tag") == 0) {
    $end = $startPlaceHolder->add(new DateInterval('P0Y0M1DT0H0M0S'));
} elseif (strcasecmp($tarifName, "wochenend") == 0) {
    $end = $startPlaceHolder->add(new DateInterval('P0Y0M3DT0H0M0S'));
} elseif (strcasecmp($tarifName, "monat") == 0) {
    $end = $startPlaceHolder->add(new DateInterval('P0Y1M0DT0H0M0S'));
} elseif (strcasecmp($tarifName, "jahr") == 0) {
    $end = $startPlaceHolder->add(new DateInterval('P1Y0M0DT0H0M0S'));
}

$end = $end->format("Y-m-d H:i:s");

$classId = getClassFromName($conn, $className)['Klasse_id'];
$tarifId = getTarifFromName($conn, $tarifName)['Tarif_id'];
$gestellnummer = getDeviceFromNameAsNotArray($conn, $deviceName)['Gestellnummer'];

createAusleihe($conn, $start, $end, $kundeId, $tarifId, $classId, $gestellnummer);
