<?php

include_once '../../../inc/db.inc.php';
include_once '../../../inc/functions.inc.php';

session_start();
deleteUser($conn, $_SESSION['userid']);
