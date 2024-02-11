<?php
// this configuration path for website
define('PATH', 'https://argajaladri.or.id'); // isi path dari website anda
define('SITE_URL', PATH);
define('POSITION_URL', PATH . '?page=' . $page);

define('RESOUCES', 'https://rahman115.github.io/argajaladri.or.id/resource/');

// this configuration for database website
define('DB_HOST', 'ngupasan.idweb.host'); // host yang di gunakan
define('DB_USERNAME', 'argajal3_media');
define('DB_PASSWORD', 'Abudurahman#93@');
define('DB_NAME', 'argajal3_media'); // database yang di gunakan
$db = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME) or die ("Ada Masalah Di Koneksi! - DATABASE");

?>