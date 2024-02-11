// this configuration path for website
define('PATH', 'https://argajaladri.or.id'); // isi path dari website anda
define('SITE_URL', PATH);
define('POSITION_URL', PATH . '?page=' . $page);

define('RESOUCES', 'https://rahman115.github.io/argajaladri.or.id/resource/');

// this configuration for database website

$db = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME) or die ("Ada Masalah Di Koneksi! - DATABASE");
