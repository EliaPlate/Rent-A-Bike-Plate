<?php

if (isset($_POST["submit"])) {

    include_once 'db.inc.php';
    include_once 'functions.inc.php';

    $telephone   = mysqli_real_escape_string($conn, $_POST["telephone"]);
    $street   = mysqli_real_escape_string($conn, $_POST["street"]);
    $city   = mysqli_real_escape_string($conn, $_POST["postalcode"]);
    $email      = mysqli_real_escape_string($conn, $_POST["email"]);
    $pwd        = mysqli_real_escape_string($conn, $_POST["pwd"]);
    $pwdRepeat  = mysqli_real_escape_string($conn, $_POST["pwdRepeat"]);
    $firstname  = mysqli_real_escape_string($conn, $_POST["firstname"]);
    $lastname  = mysqli_real_escape_string($conn, $_POST["lastname"]);


    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=passworddontmatch");
        exit();
    }

    createUser($conn, $firstname, $lastname, $telephone, $email, $pwd, $street, $city);
} else {
    header("location: ../signup.php");
    exit();
}
