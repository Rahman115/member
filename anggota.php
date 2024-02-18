<?php

include 'config.php';
include 'database.php';
include 'menus.php';
$access = false;
$access_edit = false;
$detail_anggota = true;
$message = null;


session_start();
if (!isset($_SESSION['username_member'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM anggota WHERE no_induk='{$_SESSION['username_member']}'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$nama = $row['nama'];

// $menu = new menus();




$ns = new menus();
$table = new resultset('anggota');
$tb_angg = $table->toArray();
$dt_anggota_array = array();

if (isset($_POST['dt_nama_lengkap'])) {
    $data = array();

    $data['id_anggota'] = $_POST['dt_id_anggota'];
    $data['nama'] = $_POST['dt_nama_lengkap'];
    $data['no_induk'] = $_POST['dt_nomor_anggota'];
    $data['angkatan'] = $_POST['dt_angkatan'];
    $data['tgl_lahir'] = $_POST['dt_tgl_lahir'];
    $data['darah'] = $_POST['dt_darah'];
    $data['kelamin'] = $_POST['dt_kelamin'];
    $data['agama'] = $_POST['dt_agama'];
    $data['pekerjaan'] = $_POST['dt_pekerjaan'];
    $data['alamat'] = $_POST['dt_alamat'];
    $data['hp'] = $_POST['dt_hp'];
    $data['email'] = $_POST['dt_email'];
    $data['lapangan'] = $_POST['dt_lapangan'];

    $ss = $table->toUpdate($data, array('id_anggota' => $data['id_anggota']));
    if($ss == "success"){
        $message = "Data Anda Berhasil Disimpan";
        header("Refresh: 5");
    }
    // var_dump($ss);
}

if (isset($_GET['pages'])) {
    $pages = $_GET['pages'];

    if ($pages == 'edit') {
        $access_edit = true;
        $detail_anggota = false;

        $ID = $_GET['keys'];
        $nomor = $_GET['detail'];
        $my_id = $table->toWhere(array('no_induk' => $nomor));
        if ($my_id) {
            $dt_anggota_array = $my_id[0];
        } else {
            echo "Data kosong";
        }
    }

    if ($pages == 'datails') {
        $access = true;
        $detail_anggota = false;
        $nomor = $_GET['detail'];
        $my_id = $table->toWhere(array('no_induk' => $nomor));
        if ($my_id) {
            $dt_anggota_array = $my_id[0];
        } else {
            echo "Data kosong";
        }

    }
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
    echo $ns->nav($nama, 'anggota');
    echo $ns->start_container('Anggota');
    ?>
    <?php
    if ($message != null) {
        ?>
        <!-- Message OK -->
        <div class="msg msg-ok">
            <p><strong><?php echo $message; ?></strong></p>
            <a href="#" class="close">close</a>
        </div>
        <!-- End Message OK -->
    <?php } ?>
    <div id="content">
        <?php if ($access_edit == true) { ?>
            <div class="box">
                <!-- Box Head -->
                <div class="box-head">
                    <h2 class="left">Edit Anggota Argajaladri</h2>
                    <div class="right">
                        <a href="<?php echo "/anggota.php?pages=datails&detail=" . $dt_anggota_array['no_induk']; ?>"
                            class="button">Kembali</a>
                    </div>
                </div>
                <!-- End Box Head -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="hidden" name="dt_id_anggota" value="<?php echo $dt_anggota_array['id_anggota']; ?>" />

                    <input type="hidden" name="dt_nomor_anggota" value="<?php echo $dt_anggota_array['no_induk']; ?>" />

                    <input type="hidden" name="dt_angkatan" value="<?php echo $dt_anggota_array['angkatan']; ?>" />

                    <!-- Form -->
                    <div class="form">
                        <p> <span class="req">max 100 symbols</span>
                            <label>Nama Lengkap <span>(Required Field)</span></label>
                            <input type="text" class="field size1" name="dt_nama_lengkap"
                                value="<?php echo $dt_anggota_array['nama']; ?>" />
                        </p>
                        <p> <span class="req"></span>
                            <label>Nomor Anggota <span>(Can't Edit)</span></label>
                            <input type="text" class="field size1" value="<?php echo $dt_anggota_array['no_induk']; ?>"
                                disabled />
                        </p>
                        <p> <span class="req"></span>
                            <label>Angkatan <span>(Can't Edit)</span></label>
                            <input type="text" class="field size1" value="<?php echo $dt_anggota_array['angkatan']; ?>"
                                disabled />
                        </p>
                        <p> <span class="req">dd/mm/yyyy OR yyyy-mm-dd</span>
                            <label>Tanggal Lahir <span>(Required Field)</span></label>
                            <input type="text" class="field size1" name="dt_tgl_lahir"
                                value="<?php echo $dt_anggota_array['tgl_lahir']; ?>" />
                        </p>
                        <p> <span class="req">A/B/AB/O</span>
                            <label>Golongan Darah <span>(Required Field)</span></label>
                            <input type="text" class="field size1" name="dt_darah"
                                value="<?php echo $dt_anggota_array['darah']; ?>" />
                        </p>
                        <p> <span class="req">Laki-Laki/Perempuan</span>
                            <label>Gendre <span>(Required Field)</span></label>
                            <input type="text" class="field size1" name="dt_kelamin"
                                value="<?php echo $dt_anggota_array['kelamin']; ?>" />
                        </p>
                        <p> <span class="req">Islam</span>
                            <label>Agama<span>(Required Field)</span></label>
                            <input type="text" class="field size1" name="dt_agama"
                                value="<?php echo $dt_anggota_array['agama']; ?>" />
                        </p>
                        <p> <span class="req">Max 50 symbols</span>
                            <label>Pekerjaan<span>(Required Field)</span></label>
                            <input type="text" class="field size1" name="dt_pekerjaan"
                                value="<?php echo $dt_anggota_array['pekerjaan']; ?>" />
                        </p>
                        <!-- <p class="inline-field">
                            <label>Date</label>
                            <select class="field size2">
                                <option value="">23</option>
                            </select>
                            <select class="field size3">
                                <option value="">July</option>
                            </select>
                            <select class="field size3">
                                <option value="">2009</option>
                            </select>
                        </p> -->
                        <p> <span class="req">max 100 symbols</span>
                            <label>Alamat <span>(Required Field)</span></label>
                            <textarea name="dt_alamat" class="field size1" rows="5"
                                cols="10"><?php echo $dt_anggota_array['alamat']; ?></textarea>
                        </p>
                        <p> <span class="req">Conect WA</span>
                            <label>Nomor Telepon<span>(Required Field)</span></label>
                            <input type="text" class="field size1" name="dt_hp"
                                value="<?php echo $dt_anggota_array['hp']; ?>" />
                        </p>
                        <p> <span class="req">example@gmail.com</span>
                            <label>E Mail<span>(Required Field)</span></label>
                            <input type="text" class="field size1" name="dt_email"
                                value="<?php echo $dt_anggota_array['email']; ?>" />
                        </p>
                        <p> <span class="req">Max 50 symbols</span>
                            <label>Nama Lapangan<span>(Required Field)</span></label>
                            <input type="text" class="field size1" name="dt_lapangan"
                                value="<?php echo $dt_anggota_array['lapangan']; ?>" />
                        </p>
                    </div>
                    <!-- End Form -->
                    <!-- Form Buttons -->
                    <div class="buttons">
                        <input type="submit" class="button" value="SIMPAN" />
                    </div>
                    <!-- End Form Buttons -->
                </form>
            </div>
        <?php } ?>



        <?php
        if ($access == true) {
            ?>
            <div class="box">
                <!-- Box Head -->
                <div class="box-head">
                    <h2 class="left">Detail Anggota</h2>
                </div>
                <div class="table">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="140">Nama Anggota</td>
                            <td><b>
                                    <?php echo $dt_anggota_array['nama']; ?>
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td>Nomor Anggota</td>
                            <td>
                                <?php echo $dt_anggota_array['no_induk']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Angkatan</td>
                            <td>
                                <?php echo $dt_anggota_array['angkatan']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>
                                <?php echo $dt_anggota_array['tgl_lahir']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Golongan Darah</td>
                            <td>
                                <?php echo $dt_anggota_array['darah']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>
                                <?php echo $dt_anggota_array['kelamin']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>
                                <?php echo $dt_anggota_array['agama']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>
                                <?php echo $dt_anggota_array['pekerjaan']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>
                                <?php echo $dt_anggota_array['alamat']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Nomor Telp</td>
                            <td>
                                <?php echo $dt_anggota_array['hp']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                                <?php echo $dt_anggota_array['email']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Lapangan</td>
                            <td>
                                <?php echo $dt_anggota_array['lapangan']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <a href="anggota.php?pages=edit&keys=<?php echo $dt_anggota_array['id_anggota']; ?>&detail=<?php echo $dt_anggota_array['no_induk']; ?>"
                                    class="ico edit">Edit</a>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>

            <?php
        }
        ?>

        <?php

        if ($detail_anggota == true) {
            ?>
            <!-- Box -->
            <div class="box">
                <!-- Box Head -->
                <div class="box-head">
                    <h2 class="left">Daftar Anggota Argajaladri</h2>
                </div>
                <!-- Table -->
                <div class="table">
                    <table id="tabel-data" width="100%" border="0" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="13"><input type="checkbox" class="checkbox" /></th>
                                <th>Nama Anggota</th>
                                <th>Nomor Anggota</th>
                                <th>Angkatan</th>
                                <th width="110" class="ac">Content Control</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            for ($i = 0; $i < count($tb_angg); $i++) {
                                ?>
                                <tr <?php if ($i % 2) {
                                    echo "class='odd'";
                                } ?>>
                                    <td><input type="checkbox" class="checkbox" /></td>
                                    <td>
                                        <h3><a
                                                href="<?php echo "/anggota.php?pages=datails&detail=" . $tb_angg[$i]['no_induk']; ?>">
                                                <?php echo $tb_angg[$i]['nama']; ?>
                                            </a></h3>
                                    </td>
                                    <td>
                                        <?php echo $tb_angg[$i]['no_induk']; ?>
                                    </td>
                                    <td>
                                        <?php echo $tb_angg[$i]['angkatan']; ?>
                                    </td>
                                    <td><a href="<?php echo "/anggota.php?pages=edit&keys=" . $tb_angg[$i]['id_anggota'] . "&detail=" . $tb_angg[$i]['no_induk']; ?>"
                                            class="ico edit">Edit</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <!-- Pagging -->
                    <!-- <div class="pagging">
                    <div class="left">Showing 1-12 of 44</div>
                    <div class="right"> <a href="#">Previous</a> <a href="#">1</a> <a href="#">2</a> <a href="#">3</a>
                        <a href="#">4</a> <a href="#">245</a> <span>...</span> <a href="#">Next</a> <a href="#">View
                            all</a>
                    </div>
                </div> -->
                    <!-- End Pagging -->
                </div>
                <!-- Table -->
            </div>
        <?php } ?>
    </div>
    <?php
    echo $ns->end_container();
    echo $ns->footers();
    ?>

    <script>
        $(document).ready(function () {
            $('#tabel-data').DataTable();
        });
    </script>
</body>

</html>