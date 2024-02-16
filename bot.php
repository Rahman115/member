<?php

include 'config.php';
include 'database.php';
include 'class.php';
$token = '6722321373:AAH8AAzN9IPM2NBCyPGOYrHc7CYFJe2aBxM';
$channel = '-1002041569106';

$bot = new bot($token);
$message = null;

// call database
$users = new resultset('anggota');
$adm = new resultset('member');
$ang = new resultset('generation');

if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
    $data = $bot->contect('php://input');


    $verifikasi = false;
    if (isset($_POST['username']) && !empty($_POST['username'])) {
        $nomor = $_POST['username'];
        $verifikasi = true;
    } else {
        $nomor = 'No Name';
    }

    $user = $users->toWhere(array('no_induk' => $nomor));

    $userId = $channel;
    if ($verifikasi && $user != null) {

        $admin = $adm->toWhere(array('username' => $user[0]['no_induk']));
        if ($admin == null) {
            $angkatan = $ang->toWhere(array('name' => $user[0]['angkatan']));
            $answer = $angkatan[0]['year'];

            $dtAdmin = array(
                'username' => $user[0]['no_induk'],
                'password' => '',
                'email' => $_POST['email'],
                'quest' => $answer,
                'verifikasi' => md5($user[0]['no_induk']),
                'status' => 'unvalid'
            );

            $cek = $adm->toInsert($dtAdmin);
            if ($cek) {
                $message = $dtAdmin['verifikasi'];
            } else {
                $message = null;
            }

        } else {
            $message = "Anda telah punya Akun";
        }

        $keyboard = [
            'inline_keyboard' => [
                [
                    ['text' => 'Set Password', 'url' => 'https://member.argajaladri.or.id/register.php?keys=' . $dtAdmin['verifikasi']]
                ]
            ]
        ];
        $encodedKeyboard = json_encode($keyboard);

        $email = "<i><strong >Salam Lestari!!</strong></i>
    <blockquote>Sistem Kami telah mengkonfirmasi identitas Anda dan merupakan salah satu Anggota Argajaladri.</blockquote>

    Nama Anggota : <tg-spoiler><b>" . $user[0]['nama'] . "</b></tg-spoiler>
    Email : <strong>" . $_POST['email'] . "</strong>
    Angkatan : " . $user[0]['angkatan'] . "
    <i></i>
    
    ";

        if ($message == null) {
            $email .= " <i> " . $message . "</i>";
            $encodedKeyboard = "";
        } else if ($message == "Anda telah punya Akun") {
            $email .= " <i> " . $message . "</i>";
            $encodedKeyboard = "";
        } else {
            $email .= " <blockquote> Cobalah mengingat pertanyaan ini . 

            <strong>> " . $user[0]['angkatan'] . " dilantik pada tahun ?</strong></blockquote>
            <i></i>
            <i>Untuk melanjutkan silahkan klik <strong>Set Pasword</strong> untuk melanjutkan ...</i>";
            $encodedKeyboard = json_encode($keyboard);
        }



    } else {
        $email = "<blockquote>Maaf, Sistem kami tidak mengenal anda !!</blockquote>";
        $encodedKeyboard = "";
    }

    $parameter = array(
        "chat_id" => $userId,
        "text" => $email,
        "parse_mode" => "html",
        "reply_markup" => $encodedKeyboard
    );

    // $api = "https://api.telegram.org/bot" . $token . "/sendMessage";



}

$r = $bot->ex($parameter, "sendMessage");

// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, $api);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameter));

// $result = curl_exec($ch);
// curl_close($ch);



header("Location: https://t.me/+BmlAhs0rixEwOTQ1");
// var_dump($user[0]);
// var_dump($result);


?>