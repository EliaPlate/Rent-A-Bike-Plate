<?php
session_start();
include_once '../../../inc/db.inc.php';
include_once '../../../inc/functions.inc.php';

if (array_key_exists('repair__value', $_POST)) {

    $repairId = $_POST['repair__value'];

    $repair = getRepairAsArray($conn, $repairId);

    if ($repair == null) {
        header("location: search.repair.php?error=INVALID_REPAIR_ID");
        exit();
        return;
    }
    $_SESSION['REPAIR'] = $repair;
    header("location: search.repair.php");
    exit();
} elseif (array_key_exists('gestellnummer__value', $_POST)) {
    $gestellNummer = $_POST['gestellnummer__value'];

    $repair = getRepairFromGestellNummer($conn, $gestellNummer);

    if ($repair == null) {
        header("location: search.repair.php?error=INVALID_GESTELLNUMMER");
        exit();
        return;
    }
    $_SESSION['REPAIR'] = $repair;
    header("location: search.repair.php");
    exit();
} elseif (array_key_exists('device__gestellnummer__value', $_POST)) {

    $gestellNummer = $_POST['device__gestellnummer__value'];

    $device = getDeviceAsArray($conn, $gestellNummer);

    if ($device == null) {
        header("location: search.device.php?error=INVALID");
        exit();
        return;
    }
    $_SESSION['DEVICE'] = $device;
    header("location: search.device.php");
    exit();
} elseif (array_key_exists('name__value', $_POST)) {

    $name = $_POST['name__value'];

    $device = getDeviceFromName($conn, $name);

    if ($device == null) {
        header("location: search.device.php?error=INVALID");
        exit();
        return;
    }
    $_SESSION['DEVICE'] = $device;
    header("location: search.device.php");
    exit();
} elseif (array_key_exists('class_name__value', $_POST)) {

    $name = $_POST['class_name__value'];

    $class = getClassFromName($conn, $name);

    if ($class == null) {
        header("location: search.device.php?error=INVALID");
        exit();
        return;
    }
    $classId = $class['Klasse_id'];

    $device = getDeviceFromClassId($conn, $classId);

    $_SESSION['DEVICE'] = $device;
    header("location: search.device.php");
    exit();
} elseif (array_key_exists('station__value', $_POST)) {

    $stationId = $_POST['station__value'];

    $device = getDeviceFromStationId($conn, $stationId);

    if ($device == null) {
        header("location: search.device.php?error=INVALID");
        exit();
        return;
    }

    $_SESSION['DEVICE'] = $device;
    header("location: search.device.php");
    exit();
} elseif (array_key_exists('member__id__value', $_POST)) {

    $memberId = $_POST['member__id__value'];

    $member = getMemberAsArray($conn, $memberId);

    if ($member == null) {
        header("location: search.member.php?error=INVALID");
        exit();
        return;
    }

    $_SESSION['MEMBER'] = $member;
    header("location: search.member.php");
    exit();
} elseif (array_key_exists('member__firstname__value', $_POST)) {

    $memberFirstName = $_POST['member__firstname__value'];

    $member = getMemberFromFirstName($conn, $memberFirstName);

    if ($member == null) {
        header("location: search.member.php?error=INVALID");
        exit();
        return;
    }

    $_SESSION['MEMBER'] = $member;
    header("location: search.member.php");
    exit();
} elseif (array_key_exists('member__lastname__value', $_POST)) {

    $memberLastName = $_POST['member__lastname__value'];

    $member = getMemberFromLastName($conn, $memberLastName);

    if ($member == null) {
        header("location: search.member.php?error=INVALID");
        exit();
        return;
    }

    $_SESSION['MEMBER'] = $member;
    header("location: search.member.php");
    exit();
} elseif (array_key_exists('member__email__value', $_POST)) {

    $memberEmail = $_POST['member__email__value'];

    $member = getMemberFromEMail($conn, $memberEmail);

    if ($member == null) {
        header("location: search.member.php?error=INVALID");
        exit();
        return;
    }

    $_SESSION['MEMBER'] = $member;
    header("location: search.member.php");
    exit();
} elseif (array_key_exists('member_town__value', $_POST)) {

    $memberCityPLZ = $_POST['member_town__value'];

    $member = getMemberFromPLZ($conn, $memberCityPLZ);

    if ($member == null) {
        header("location: search.member.php?error=INVALID");
        exit();
        return;
    }

    $_SESSION['MEMBER'] = $member;
    header("location: search.member.php");
    exit();
} elseif (array_key_exists('member_role__value', $_POST)) {

    $memberRoleId = $_POST['member_role__value'];

    $member = getMemberFromRoleId($conn, $memberRoleId);

    if ($member == null) {
        header("location: search.member.php?error=INVALID");
        exit();
        return;
    }

    $_SESSION['MEMBER'] = $member;
    header("location: search.member.php");
    exit();
} elseif (array_key_exists('station__id__value', $_POST)) {

    $stationId = $_POST['station__id__value'];

    $station = getStationAsArray($conn, $stationId);

    if ($station == null) {
        header("location: search.place.php?error=INVALID");
        exit();
        return;
    }

    $_SESSION['STATION'] = $station;
    header("location: search.place.php");
    exit();
} elseif (array_key_exists('station__street__value', $_POST)) {

    $stationStreet = $_POST['station__street__value'];

    $station = getStationFromStreet($conn, $stationStreet);

    if ($station == null) {
        header("location: search.place.php?error=INVALID");
        exit();
        return;
    }

    $_SESSION['STATION'] = $station;
    header("location: search.place.php");
    exit();
} elseif (array_key_exists('station_town__value', $_POST)) {

    $stationPostalcode = $_POST['station_town__value'];

    $station = getStationFromPostalCode($conn, $stationPostalcode);

    if ($station == null) {
        header("location: search.place.php?error=INVALID");
        exit();
        return;
    }

    $_SESSION['STATION'] = $station;
    header("location: search.place.php");
    exit();
}
