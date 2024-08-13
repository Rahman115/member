<?php

include 'config.php';
include 'database.php';
include 'menus.php';

$ns = new menus();

session_start();
if (!isset($_SESSION['username_member'])) {
    header("Location: login.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Angkatan Argajaladri</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

    <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
</head>

<body>
    <?php
    echo $ns->nav($nama, 'pengurus');
    echo $ns->start_container('Pengurus');
    ?>
    <?php
    echo $ns->end_container();
    echo $ns->footers();
    ?>

</body>

</html>