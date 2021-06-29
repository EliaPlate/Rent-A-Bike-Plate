<?php
session_start();

include_once '../../../inc/db.inc.php';
include_once '../../../inc/functions.inc.php';

$id = $_SESSION['userid'];

if (array_key_exists('firstname__value', $_POST)) {

    $newFirstName = $_POST['firstname__value'];

    if (strlen($newFirstName) > 10) {
        header("location: user.edit.php?error=FIRSTNAME_LONG");
        exit();
        return;
    }

    $stmt = $conn->prepare("UPDATE kunde SET Vorname = ? WHERE Kunde_id = '$id'");
    $stmt->bind_param("s", $newFirstName);
    $stmt->execute();
    $stmt->close();
} elseif (array_key_exists('lastname__value', $_POST)) {
    $newLastName = $_POST['lastname__value'];

    if (strlen($newLastName) > 10) {
        header("location: user.edit.php?error=LASTNAME_LONG");
        exit();
        return;
    }

    $stmt = $conn->prepare("UPDATE kunde SET Nachname = ? WHERE Kunde_id = '$id'");
    $stmt->bind_param("s", $newLastName);
    $stmt->execute();
    $stmt->close();
} elseif (array_key_exists('telephone__value', $_POST)) {
    $newTelephone = $_POST['telephone__value'];

    $stmt = $conn->prepare("UPDATE kunde SET Telefonnummer = ? WHERE Kunde_id = '$id'");
    $stmt->bind_param("s", $newTelephone);
    $stmt->execute();
    $stmt->close();
} elseif (array_key_exists('email__value', $_POST)) {
    $newEmail = $_POST['email__value'];

    if (invalidEmail($newEmail)) {
        header("location: user.edit.php?error=INVALID_EMAIL");
        exit();
        return;
    }

    $stmt = $conn->prepare("UPDATE kunde SET Email = ? WHERE Kunde_id = '$id'");
    $stmt->bind_param("s", $newEmail);
    $stmt->execute();
    $stmt->close();
} elseif (array_key_exists('password__value', $_POST)) {
    $password = $_POST['password__value'];

    if (strlen($password) < 6) {
        header("location: user.edit.php?error=PASSWORD_SHORT");
        exit();
        return;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE kunde SET Passwort = ? WHERE Kunde_id = '$id'");
    $stmt->bind_param("s", $hashedPassword);
    $stmt->execute();
    $stmt->close();
} elseif (array_key_exists('street__value', $_POST)) {
    $newStreet = $_POST['street__value'];

    $stmt = $conn->prepare("UPDATE kunde SET Straße = ? WHERE Kunde_id = '$id'");
    $stmt->bind_param("s", $newStreet);
    $stmt->execute();
    $stmt->close();
} elseif (array_key_exists('town__value', $_POST)) {
    $newTown = $_POST['town__value'];

    $townID = getTownIdFromName($conn, $newTown);

    $stmt = $conn->prepare("UPDATE kunde SET PLZ = ? WHERE Kunde_id = '$id'");
    $stmt->bind_param("i", $townID);
    $stmt->execute();
    $stmt->close();
}
header("location: user.edit.php");
exit();
