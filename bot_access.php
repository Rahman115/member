<?php 
include('config.php');
$url = 'https://member.argajaladri.or.id/bot_access.php';

$apiUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/getMe";


$apiSetWebhook = "https://api.telegram.org/bot" . BOT_TOKEN . "/setWebhook?url=" . $url;

$apiWebhookInfo = "https://api.telegram.org/bot" . BOT_TOKEN . "/getWebhookInfo";
$apiGetUpdate= "https://api.telegram.org/bot" . BOT_TOKEN . "/getUpdates";

$data = file_get_contents('php://input');
$getData = json_decode($data, true);
// $userId = $getData


// $response = file_get_contents($apiUrl);
$up = file_get_contents($apiGetUpdate);
// $r = file_get_contents($apiSetWebhhook);
// $res = file_get_contents($apiWebhookInfo);

// echo $response;
// echo "<br>";
// echo $r;
// echo "<br>";
// echo $res;
// echo "<br>";
// var_dump($getData);
// var_dump($up);  
// var_dump($up);  

// $data = file_get_contents('php://input');
// $logFile = "webhooksentdata.json";
// $log = fopen($logFile,"a");
// fwrite($log, $data);
// fclose($log);

?>