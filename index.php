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
$artikel = new resultset('artikel');
$mn = new menus();
// var_dump($table->toArray());
//$angkatan = new model('generation');
//$arr = $angkatan->dataArray();

$tb_angkatan = $table->toArray();
$tb_artikel = $artikel->toArray();



$sql = "SELECT * FROM anggota WHERE no_induk='{$_SESSION['username_member']}'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$nama = $row['nama'];
$id = $row['no_induk'];

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
                            <th>Judul Artikel</th>
                            <th>Penulis</th>
                            <th>Upload</th>
                            <th width="110" class="ac">Content Control</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        for ($i = 0; $i < count($tb_artikel); $i++) {
                            ?>
                            <tr <?php if ($i % 2) {
                                echo "class='odd'";
                            } ?>>
                                <td><input type="checkbox" class="checkbox" /></td>
                                <td>
                                    <h3><a href="artikel.php?action=read&follow=<?php echo $tb_artikel[$i]['link']; ?>">
                                            <?php echo $tb_artikel[$i]['judul']; ?>
                                        </a></h3>
                                </td>
                                <td>
                                    <?php echo $tb_artikel[$i]['penulis']; ?>
                                </td>
                                <td>
                                    <?php echo $tb_artikel[$i]['tanggal']; ?>
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
    <!-- Sidebar -->
    <div id="sidebar">
        <!-- Box -->
        <div class="box">
            <!-- Box Head -->
            <div class="box-head">
                <h2>Management</h2>
            </div>
            <!-- End Box Head-->
            <div class="box-content"> <a href="/artikel.php?action=add&follow=new-artikel" class="add-button"><span>Add
                        New Article</span></a>
                <div class="cl">&nbsp;</div>
                <!-- <p class="select-all">
                    <input type="checkbox" class="checkbox" />
                    <label>select all</label>
                </p> -->
                <!-- <p><a href="#">Delete Selected</a></p> -->
                <!-- Sort -->
                <!-- <div class="sort">
                    <label>Sort by</label>
                    <select class="field">
                        <option value="">Title</option>
                    </select>
                    <select class="field">
                        <option value="">Date</option>
                    </select>
                    <select class="field">
                        <option value="">Author</option>
                    </select>
                </div> -->
                <!-- End Sort -->
            </div>

        </div>
        <!-- End Box -->
        <!-- Box -->
        <div class="box">
            <!-- Box Head -->
            <div class="box-head">
                <h2>Kategori</h2>
            </div>
            <!-- End Box Head-->
            <div class="box-content">
                <a href="/artikel.php?action=add&follow=new-artikel" class="add-button">
                    <span>Add Kategori</span>
                </a>
                <div class="cl">&nbsp;</div>
                <p style="display: grid; width:100%; grid-template-columns: auto auto;">
                    <?php
                    $tag = new resultset('tag');
                    $data_tag = $tag->toArray();
                    for ($i = 0; $i < count($data_tag); $i++) {
                        ?>
                        <span style="border: 1px solid rgba(0, 0, 0, 0.6); background-color: rgba(255, 255, 255, 1);
                        border-radius: 3px; padding:5px 10px 5px 10px; margin: 4px 8px 4px 8px; text-align: center;">
                            <?php echo $data_tag[$i]['tag_name']; ?>
                        </span>
                        <?php
                    }
                    ?>
                </p>
                <div class="cl">&nbsp;</div>
            </div>

        </div>
        <!-- End Box -->
    </div>
    <!-- End Sidebar -->
    <?php echo $mn->end_container(); ?>
    <!-- End Container -->

    <!-- Footer -->
    <?php echo $mn->footers(); ?>
    <!-- End Footer -->

    <!-- <footer id="footer"
        style="position: fixed; left: 0; bottom: 0; width: 100%; background-color: red; color: white; text-align: center;">
        Foot</footer> -->
    <script>
        $(document).ready(function () {
            $('#tabel-data').DataTable();
        });
    </script>
</body>

</html>