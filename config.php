<?php

// this configuration for database website
define('DB_HOST', 'ngupasan.idweb.host'); // host yang di gunakan
//define('DB_HOST', 'localhost'); // host yang di gunakan
//define('DB_HOST', '203.161.185.210');

// define('DB_USERNAME', 'root');
define('DB_USERNAME', 'argajal3_media');

// argajal3_media
// Abudurahman#93@

define('DB_PASSWORD', 'Abudurahman#93@');
define('DB_NAME', 'argajal3_media'); // database yang di gunakan

// argajala_media
// Abdurrahman93@
// 125.160.236.245

$db = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME) or die ("Ada Masalah Di Koneksi! - DATABASE");

?>