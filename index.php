<?php
include 'config.php';
include 'database.php';
include 'menus.php';
session_start();
if (!isset($_SESSION['username_member'])) {
    header("Location: login.php");
    exit();
}

// $database = new database();
// $data = $database->getAll('generation');

$table = new resultset('generation');
$mn = new menus();
// var_dump($table->toArray());
//$angkatan = new model('generation');
//$arr = $angkatan->dataArray();

$tb_angkatan = $table->toArray();



$sql = "SELECT * FROM anggota WHERE no_induk='{$_SESSION['username_member']}'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$nama = $row['nama'];

// var_dump($arr);
//var_dump($row_angkatan);
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Argajaladri</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

    <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
</head>

<body>
    <!-- Header -->
    <?php echo $mn->nav($nama, 'dashboard'); ?>
    <!-- End Header -->
    <!-- Container -->
    <?php echo $mn->start_container('Dashboard'); ?>
    <!-- Content -->
    <div id="content">
        <!-- Box -->
        <div class="box">
            <!-- Box Head -->
            <div class="box-head">
                <h2 class="left">Artikel </h2>

            </div>

            <!-- Table -->
            <div class="table">
                <table id="tabel-data" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th width="13"><input type="checkbox" class="checkbox" /></th>
                            <th>Nama Angkatan</th>
                            <th>Arti Angkatan</th>
                            <th>Tahun</th>
                            <th width="110" class="ac">Content Control</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        for ($i = 0; $i < count($tb_angkatan); $i++) {
                            ?>
                            <tr <?php if ($i % 2) {
                                echo "class='odd'";
                            } ?>>
                                <td><input type="checkbox" class="checkbox" /></td>
                                <td>
                                    <h3><a href="#">
                                            <?php echo $tb_angkatan[$i]['name']; ?>
                                        </a></h3>
                                </td>
                                <td>
                                    <?php echo $tb_angkatan[$i]['arti']; ?>
                                </td>
                                <td>
                                    <?php echo $tb_angkatan[$i]['year']; ?>
                                </td>
                                <td><a href="#" class="ico del">Delete</a><a href="#" class="ico edit">Edit</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- Pagging -->
                <div class="pagging">
                    <div class="left">Showing 1-12 of 44</div>
                    <div class="right"> <a href="#">Previous</a> <a href="#">1</a> <a href="#">2</a> <a href="#">3</a>
                        <a href="#">4</a> <a href="#">245</a> <span>...</span> <a href="#">Next</a> <a href="#">View
                            all</a>
                    </div>
                </div>
                <!-- End Pagging -->
            </div>
            <!-- Table -->
        </div>
    </div>
    <?php echo $mn->end_container(); ?>
    <!-- End Container -->
    <!-- Footer -->
    <?php echo $mn->footers(); ?>
    <!-- End Footer -->
    <script>
        $(document).ready(function () {
            $('#tabel-data').DataTable();
        });
    </script>
</body>

</html>