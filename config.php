<?php

$page = (isset($_GET['page']) && $_GET['page']) ? $_GET['page'] : '';

// this configuration path for website
define('PATH', 'https://argajaladri.or.id'); // isi path dari website anda
define('SITE_URL', PATH);
define('POSITION_URL', PATH . '?page=' . $page);

define('RESOUCES', 'https://rahman115.github.io/argajaladri.or.id/resource/');

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

$nama_tabel = "adminmaster";

$sql = "select * from " . $nama_tabel;

// var_dump(mysqli_fetch_assoc($db->query($sql)));

class dbs  {
    
    public $data;
    
    public function __construct(){
        //$this->query = $queryName;
        
        // echo 'Saya construct';
    }
    
    public function ff(){
        return "Hello world";
    }
    
}

$dbs = new dbs();

// echo $dbs->ff();

// var_dump($data);

?>

