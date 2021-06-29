<?php
require_once 'db.inc.php';
?>
<?php

function emptyInputSignup($username, $email, $pwd, $pwdRepeat)
{
    if (empty($username) || empty($email) || empty($pwd) || empty($pwdRepeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function emptyClubInputSignup($clubName, $postalCode)
{
    if (empty($clubName) || empty($postalCode)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidUsername($username)
{
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat)
{
    if ($pwd !== $pwdRepeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function UsernameExists($conn, $vorname, $email)
{
    $sql    = "SELECT * FROM kunde WHERE vorname = ? OR email = ?;";
    $stmt   = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=SELECTFAILED");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $vorname, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
}
function humanNameExists($conn, $firstname, $lastname)
{
    $sql    = "SELECT * FROM kunde WHERE vorname = ? OR nachname = ?;";
    $stmt   = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=SELECTFAILED");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $firstname, $lastname);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
}


function createUser($conn, $firstname, $lastname, $telephone, $email, $passwort, $straße, $city)
// 
// Role_id 0 = Admin
// Role_id 1 = User
// 
{
    $sql    = "INSERT INTO kunde (vorname, nachname, telefonnummer, email, passwort, straße, plz, joined, rentToday, rentOverall, role_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt   = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=INSERTFAILED");
        exit();
    }

    $date = date('Y-m-d H:i:s');

    $hashedPassword = password_hash($passwort, PASSWORD_DEFAULT);

    $role_id = 1;
    $rent = 0;
    $postalcode = getTownIdFromName($conn, $city);

    mysqli_stmt_bind_param($stmt, "ssssssisiii", $firstname, $lastname, $telephone, $email, $hashedPassword, $straße, $postalcode, $date, $rent, $rent, $role_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit();
}

function createAusleihe($conn, $start, $end, $kundeId, $tarifId, $klasseId, $gestellnummer)
{
    $sql = "INSERT INTO ausleihe (Start, Ende, Kunde_id, Tarif_id, Klasse_id, Gestellnummer) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: rent.php?error=INSERTFAILED");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssiiii", $start, $end, $kundeId, $tarifId, $klasseId, $gestellnummer);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: rent.calendar.php");
    exit();
}


function deleteUser($conn, $id)
{

    $stmt = $conn->prepare("DELETE FROM kunde WHERE Kunde_id = '$id'");

    $stmt->execute();
    $stmt->close();

    session_unset();
    session_destroy();
    header("location: ../../../index.php?error=none");
    exit();
}

function getRoleName($conn, $userId)
{
    $query = $conn->query("SELECT role_id FROM kunde WHERE kunde_id = '$userId'");

    if ($query->num_rows <= 0) return null;

    $role_id = $query->fetch_assoc()['role_id'];

    $roleQuery = $conn->query("SELECT name FROM role WHERE role_id = '$role_id'");

    $role_name = $roleQuery->fetch_assoc()['name'];
    return $role_name;
}



function getTownIdFromName($conn, $townName)
{
    $query = $conn->query("SELECT plz FROM ort WHERE name ='$townName'");
    if ($query->num_rows <= 0) {
        return null;
    }
    $id = $query->fetch_assoc()['plz'];
    return $id;
}




function getTownFromId($conn, $id)
{
    $query = $conn->query("SELECT * FROM ort WHERE PLZ ='$id'");
    if ($query->num_rows <= 0) {
        return null;
    }
    $id = $query->fetch_assoc();
    return $id;
}

function getRepair($conn, $id)
{
    $query = $conn->query("SELECT * FROM reparaturen WHERE reperatur_id = '$id'");
    if ($query->num_rows <= 0) {
        return null;
    }
    return $query->fetch_assoc();
}


function getRepairAsArray($conn, $id)
{
    $query = $conn->query("SELECT * FROM reparaturen WHERE reperatur_id = '$id'");
    if ($query->num_rows <= 0) {
        return null;
    }
    $array = array();

    while ($row = mysqli_fetch_array($query)) {
        array_push($array, $row['Reperatur_id']);
    }

    return $array;
}

function getCurrentRentFromMember($conn, $kundeId)
{
    $query = $conn->query("SELECT Ende FROM ausleihe WHERE Kunde_id ='$kundeId'");
    if ($query->num_rows <= 0) {
        return 0;
    }
    $current = 0;
    $date = date('Y-m-d H:i:s');

    while ($row = mysqli_fetch_array($query)) {
        if ($date > $row['Ende']) {
            continue;
        }
        $current++;
    }
    return $current;
}
function getOverallRentFromMember($conn, $kundeId)
{
    $query = $conn->query("SELECT * FROM ausleihe WHERE Kunde_id ='$kundeId'");
    if ($query->num_rows <= 0) {
        return 0;
    }
    $overall = 0;
    for ($i = 0; $i < $query->num_rows; $i++) {
        $overall += 1;
    }
    return $overall;
}

function getDeviceAsArray($conn, $id)
{
    $query = $conn->query("SELECT * FROM gerät WHERE gestellnummer = '$id'");
    if ($query->num_rows <= 0) {
        return null;
    }
    $array = array();

    while ($row = mysqli_fetch_array($query)) {
        array_push($array, $row['Gestellnummer']);
    }

    return $array;
}



function getDeviceFromName($conn, $name)
{
    $query = $conn->query("SELECT * FROM gerät WHERE name = '$name'");
    if ($query->num_rows <= 0) {
        return null;
    }
    $array = array();

    while ($row = mysqli_fetch_array($query)) {
        array_push($array, $row['Gestellnummer']);
    }

    return $array;
}
function getDeviceFromClassId($conn, $id)
{
    $query = $conn->query("SELECT * FROM gerät WHERE Klasse_id = '$id'");
    if ($query->num_rows <= 0) {
        return null;
    }
    $array = array();

    while ($row = mysqli_fetch_array($query)) {
        array_push($array, $row['Gestellnummer']);
    }

    return $array;
}
function getDeviceFromStationId($conn, $id)
{
    $query = $conn->query("SELECT * FROM gerät WHERE Station_id = '$id'");
    if ($query->num_rows <= 0) {
        return null;
    }
    $array = array();

    while ($row = mysqli_fetch_array($query)) {
        array_push($array, $row['Gestellnummer']);
    }

    return $array;
}

function getMemberAsArray($conn, $id)
{
    $query = $conn->query("SELECT * FROM kunde WHERE Kunde_id = '$id'");
    if ($query->num_rows <= 0) {
        return null;
    }
    $array = array();

    while ($row = mysqli_fetch_array($query)) {
        array_push($array, $row['Kunde_id']);
    }

    return $array;
}

function getStationAsArray($conn, $id)
{
    $query = $conn->query("SELECT * FROM ausleihstation WHERE Station_id = '$id'");
    if ($query->num_rows <= 0) {
        return null;
    }
    $array = array();

    while ($row = mysqli_fetch_array($query)) {
        array_push($array, $row['Station_id']);
    }

    return $array;
}

function getStationFromStreet($conn, $street)
{
    $query = $conn->query("SELECT * FROM ausleihstation WHERE Straße = '$street'");
    if ($query->num_rows <= 0) {
        return null;
    }
    $array = array();

    while ($row = mysqli_fetch_array($query)) {
        array_push($array, $row['Station_id']);
    }

    return $array;
}

function getStationFromPostalCode($conn, $postalCode)
{
    $query = $conn->query("SELECT * FROM ausleihstation WHERE PLZ = '$postalCode'");
    if ($query->num_rows <= 0) {
        return null;
    }
    $array = array();

    while ($row = mysqli_fetch_array($query)) {
        array_push($array, $row['Station_id']);
    }

    return $array;
}

function getMemberFromFirstName($conn, $firstName)
{
    $query = $conn->query("SELECT * FROM kunde WHERE Vorname = '$firstName'");
    if ($query->num_rows <= 0) {
        return null;
    }
    $array = array();

    while ($row = mysqli_fetch_array($query)) {
        array_push($array, $row['Kunde_id']);
    }

    return $array;
}

function getMemberFromLastName($conn, $lastName)
{
    $query = $conn->query("SELECT * FROM kunde WHERE Nachname = '$lastName'");
    if ($query->num_rows <= 0) {
        return null;
    }
    $array = array();

    while ($row = mysqli_fetch_array($query)) {
        array_push($array, $row['Kunde_id']);
    }

    return $array;
}

function getMemberFromEMail($conn, $email)
{
    $query = $conn->query("SELECT * FROM kunde WHERE Email = '$email'");
    if ($query->num_rows <= 0) {
        return null;
    }
    $array = array();

    while ($row = mysqli_fetch_array($query)) {
        array_push($array, $row['Kunde_id']);
    }

    return $array;
}

function getMemberFromPLZ($conn, $plz)
{
    $query = $conn->query("SELECT * FROM kunde WHERE PLZ = '$plz'");
    if ($query->num_rows <= 0) {
        return null;
    }
    $array = array();

    while ($row = mysqli_fetch_array($query)) {
        array_push($array, $row['Kunde_id']);
    }

    return $array;
}

function getMemberFromRoleId($conn, $id)
{
    $query = $conn->query("SELECT * FROM kunde WHERE role_id = '$id'");
    if ($query->num_rows <= 0) {
        return null;
    }
    $array = array();

    while ($row = mysqli_fetch_array($query)) {
        array_push($array, $row['Kunde_id']);
    }

    return $array;
}


function getRepairFromGestellNummer($conn, $id)
{
    $query = $conn->query("SELECT * FROM reparaturen WHERE gestellnummer = '$id'");
    if ($query->num_rows <= 0) {
        return null;
    }
    $array = array();

    while ($row = mysqli_fetch_array($query)) {
        array_push($array, $row['Reperatur_id']);
    }

    return $array;
}

function getMember($conn, $id)
{
    $query = $conn->query("SELECT * FROM kunde WHERE Kunde_id = '$id'");
    if ($query->num_rows <= 0) {
        return null;
    }
    return $query->fetch_assoc();
}

function getRoleFromIdFromDataBase($conn, $id)
{

    $query = $conn->query("SELECT * FROM role WHERE role_id = '$id'");
    if ($query->num_rows <= 0) {
        return null;
    }
    return $query->fetch_assoc();
}

function getDeviceFromNameAsNotArray($conn, $name)
{
    $query = $conn->query("SELECT * FROM gerät WHERE name = '$name'");
    if ($query->num_rows <= 0) {
        return null;
    }
    return $query->fetch_assoc();
}

function getUser($conn, $id, $firstname, $lastname, $email)
{
    $query = $conn->query("SELECT * FROM kunde WHERE (kunde_id = '$id' OR vorname = '$firstname' OR nachname = '$lastname' OR email = '$email')");
    if ($query->num_rows <= 0) {
        return null;
    }
    return $query->fetch_assoc();
}

function getTarif($conn, $id)
{
    $query = $conn->query("SELECT * FROM tarif WHERE Tarif_id = '$id'");
    if ($query->num_rows <= 0) {
        return null;
    }
    return $query->fetch_assoc();
}

function getTarifFromName($conn, $name)
{
    $query = $conn->query("SELECT * FROM tarif WHERE Name = '$name'");
    if ($query->num_rows <= 0) {
        return null;
    }
    return $query->fetch_assoc();
}


function getClass($conn, $id)
{
    $query = $conn->query("SELECT * FROM klasse WHERE Klasse_id = '$id'");
    if ($query->num_rows <= 0) {
        return null;
    }
    return $query->fetch_assoc();
}
function getClassFromName($conn, $name)
{
    $query = $conn->query("SELECT * FROM klasse WHERE Art = '$name'");
    if ($query->num_rows <= 0) {
        return null;
    }
    return $query->fetch_assoc();
}

function getStation($conn, $id)
{
    $query = $conn->query("SELECT * FROM ausleihstation WHERE Station_id = '$id'");
    if ($query->num_rows <= 0) {
        return null;
    }
    return $query->fetch_assoc();
}

function getDevice($conn, $id)
{
    $query = $conn->query("SELECT * FROM gerät WHERE Gestellnummer = '$id'");
    if ($query->num_rows <= 0) {
        return null;
    }
    return $query->fetch_assoc();
}



function emptyInputLogin($username, $pwd)
{
    if (empty($username) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $firstname, $pwd)
{
    $usernameExists = UsernameExists($conn, $firstname, $firstname);


    if ($usernameExists === false) {
        header("location: ../login.php?error=wronglogin1");
        exit();
    }


    $pwdHashed  = $usernameExists['Passwort'];
    $checkPwd   = password_verify($pwd, $pwdHashed);


    if ($checkPwd === false) {
        header("location: ../login.php?error=wronglogin2");
        exit();
    } else if ($checkPwd === true) {
        session_start();
        $_SESSION['userid']     = $usernameExists['Kunde_id'];
        $_SESSION['firstname']   = $usernameExists['Vorname'];
        $_SESSION['lastname']   = $usernameExists['Nachname'];
        $_SESSION['role']       = getRoleFromId($usernameExists['role_id']);
        header("location: ../index.php");
        exit();
    }
}
function isAdmin($session)
{
    return strcasecmp($session['role'], "admin") == 0;
}



function getRoleFromId($id)
{

    switch ($id) {

        case 0:
            return "Admin";
            break;
        case 1:
            return "User";
            break;
        default:
            return "User";
            break;
    }
}
