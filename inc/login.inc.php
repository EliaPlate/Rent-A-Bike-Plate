<?php

if (isset($_POST["submit"])) {

    include_once 'db.inc.php';
    include_once 'functions.inc.php';

    $firstname   = mysqli_real_escape_string($conn, $_POST['firstname']);
    $pwd        = mysqli_real_escape_string($conn, $_POST['pwd']);

    loginUser($conn, $firstname, $pwd);
} else {
    header("location: ../login.php");
    exit();
}
