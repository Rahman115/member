<?php
include 'config.php';
session_start();
if (!isset($_SESSION['username_member'])) {
    header("Location: login.php");
    exit();
}

//$database = new database();

//$angkatan = new model('generation');
//$arr = $angkatan->dataArray();





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
</head>

<body>
    <!-- Header -->
    <div id="header">
        <div class="shell">
            <!-- Logo + Top Nav -->
            <div id="top">
                <h1><a href="#">Argajaladri</a></h1>
                <div id="top-navigation"> Welcome <a href="#"><strong><?php echo $nama; ?></strong></a> <span>|</span> <a
                        href="#">Help</a> <span>|</span> <a href="#">Profile Settings</a> <span>|</span> <a
                        href="logout.php">Log out</a> </div>
            </div>
            <!-- End Logo + Top Nav -->
            <!-- Main Nav -->
            <div id="navigation">
                <ul>
                    <li><a href="#" class="active"><span>Dashboard</span></a></li>
                    <li><a href="#"><span>New Articles</span></a></li>
                    <li><a href="#"><span>User Management</span></a></li>
                    <li><a href="#"><span>Photo Gallery</span></a></li>
                    <li><a href="#"><span>Products</span></a></li>
                    <li><a href="#"><span>Services Control</span></a></li>
                </ul>
            </div>
            <!-- End Main Nav -->
        </div>
    </div>
    <!-- End Header -->
    <!-- Container -->
    <div id="container">
        <div class="shell">
            <!-- Small Nav -->
            <div class="small-nav"> <a href="#">Dashboard</a> <span>&gt;</span> Current Articles </div>


            <!-- End Small Nav -->

            <!-- Main -->
            <div id="main">
                <div class="cl">&nbsp;</div>
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
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <th width="13"><input type="checkbox" class="checkbox" /></th>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Added by</th>
                                    <th width="110" class="ac">Content Control</th>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="checkbox" /></td>
                                    <td>
                                        <h3><a href="#">Lorem ipsum dolor sit amet, consectetur.</a></h3>
                                    </td>
                                    <td>12.05.09</td>
                                    <td><a href="#">Administrator</a></td>
                                    <td><a href="#" class="ico del">Delete</a><a href="#" class="ico edit">Edit</a></td>
                                </tr>
                                <tr class="odd">
                                    <td><input type="checkbox" class="checkbox" /></td>
                                    <td>
                                        <h3><a href="#">Lorem ipsum dolor sit amet, consectetur.</a></h3>
                                    </td>
                                    <td>12.05.09</td>
                                    <td><a href="#">Administrator</a></td>
                                    <td><a href="#" class="ico del">Delete</a><a href="#" class="ico edit">Edit</a></td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="checkbox" /></td>
                                    <td>
                                        <h3><a href="#">Lorem ipsum dolor sit amet, consectetur.</a></h3>
                                    </td>
                                    <td>12.05.09</td>
                                    <td><a href="#">Administrator</a></td>
                                    <td><a href="#" class="ico del">Delete</a><a href="#" class="ico edit">Edit</a></td>
                                </tr>
                                <tr class="odd">
                                    <td><input type="checkbox" class="checkbox" /></td>
                                    <td>
                                        <h3><a href="#">Lorem ipsum dolor sit amet, consectetur.</a></h3>
                                    </td>
                                    <td>12.05.09</td>
                                    <td><a href="#">Administrator</a></td>
                                    <td><a href="#" class="ico del">Delete</a><a href="#" class="ico edit">Edit</a></td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="checkbox" /></td>
                                    <td>
                                        <h3><a href="#">Lorem ipsum dolor sit amet, consectetur.</a></h3>
                                    </td>
                                    <td>12.05.09</td>
                                    <td><a href="#">Administrator</a></td>
                                    <td><a href="#" class="ico del">Delete</a><a href="#" class="ico edit">Edit</a></td>
                                </tr>
                                <tr class="odd">
                                    <td><input type="checkbox" class="checkbox" /></td>
                                    <td>
                                        <h3><a href="#">Lorem ipsum dolor sit amet, consectetur.</a></h3>
                                    </td>
                                    <td>12.05.09</td>
                                    <td><a href="#">Administrator</a></td>
                                    <td><a href="#" class="ico del">Delete</a><a href="#" class="ico edit">Edit</a></td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" class="checkbox" /></td>
                                    <td>
                                        <h3><a href="#">Lorem ipsum dolor sit amet, consectetur.</a></h3>
                                    </td>
                                    <td>12.05.09</td>
                                    <td><a href="#">Administrator</a></td>
                                    <td><a href="#" class="ico del">Delete</a><a href="#" class="ico edit">Edit</a></td>
                                </tr>
                                <tr class="odd">
                                    <td><input type="checkbox" class="checkbox" /></td>
                                    <td>
                                        <h3><a href="#">Lorem ipsum dolor sit amet, consectetur.</a></h3>
                                    </td>
                                    <td>12.05.09</td>
                                    <td><a href="#">Administrator</a></td>
                                    <td><a href="#" class="ico del">Delete</a><a href="#" class="ico edit">Edit</a></td>
                                </tr>
                            </table>
                            <!-- Pagging -->
                            <div class="pagging">
                                <div class="left">Showing 1-12 of 44</div>
                                <div class="right"> <a href="#">Previous</a> <a href="#">1</a> <a href="#">2</a> <a
                                        href="#">3</a> <a href="#">4</a> <a href="#">245</a> <span>...</span> <a
                                        href="#">Next</a> <a href="#">View all</a> </div>
                            </div>
                            <!-- End Pagging -->
                        </div>
                        <!-- Table -->
                    </div>
                </div>
                <div class="cl">&nbsp;</div>
            </div> <!-- end Main -->
        </div>
    </div>
    <!-- End Container -->
    <!-- Footer -->
    <div id="footer">
        <div class="shell"> <span class="left">&copy; 2010 - CompanyName</span> <span class="right"> Design by <a
                    href="https://abuduchoy.my.id">abuduchoy.my.id</a> </span> </div>
    </div>
    <!-- End Footer -->
</body>

</html>