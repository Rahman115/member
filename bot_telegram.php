<?php
include('config.php');
// $data = file_get_contents('php://input');
// $logFile = "webhooksentdata.json";
// $log = fopen($logFile, "a");
// fwrite($log, $data);
// fclose($log);

// $getData = json_decode($data, true);
// $userId = $getData['message']['from']['id'];

// $userMessage = $getData['message']['text'];
$botMessage = "I Can Help You";

$userId = '6722321373';
// $userId = '@agj_1992';

$parameter = array(
    "chat_id" => $userId,
    "text" => $botMessage,
    "parse_mode" => "html"
);

// $apiMessage = file_get_contents("https://api.telegram.org/bot" . BOT_TOKEN . "/sendMessage?" . http_build_query($parameter));
// print_r(json_encode($apiMessage, JSON_PRETTY_PRINT));
print_r(json_decode($apiMessage, true));
$apiMessage = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendMessage";
// $apiMessage = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendMessage?chat_id=" . $userId . "&text=" . $botMessage;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiMessage);
// curl_setopt($ch, CURLOPT_POST, count($parameter));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameter));

$result = curl_exec($ch);
curl_close($ch);

var_dump($result);
// echo $result;

// var_dump($apiMessage);
// $url = 'https://member.argajaladri.or.id/bot_access.php';

// $apiUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/getMe";


// $apiSetWebhook = "https://api.telegram.org/bot" . BOT_TOKEN . "/setWebhook?url=" . $url;

// $apiWebhookInfo = "https://api.telegram.org/bot" . BOT_TOKEN . "/getWebhookInfo";

// $data = file_get_contents('php://input');
// $getData = json_decode($data, true);
// // $userId = $getData


// $response = file_get_contents($apiUrl);
// $r = file_get_contents($apiSetWebhook);
// $res = file_get_contents($apiWebhookInfo);

// echo $response;
// echo "<br>";
// echo $r;
// echo "<br>";
// echo $res;
// echo "<br>";
// var_dump($getData);

?>