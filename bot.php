<?php 

$token = '6722321373:AAH8AAzN9IPM2NBCyPGOYrHc7CYFJe2aBxM';
$channel = '-1002041569106';

if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
	$data = file_get_contents('php://input');
	$getData = json_decode($data, true);
	
	$keyboard = [
        'inline_keyboard' => [
            [
                ['text' => 'Set Password', 'url' => 'https://argajaladri.or.id']
            ]
        ]
    ];
	$encodedKeyboard = json_encode($keyboard);
	
	$userId = $channel;
    $email = '<i>alam Lestari!! </i> \n No Anggota : <b>' . $_POST['username'] . "</b> \n <strong> Email </strong>:" . $_POST['email'];
	$email .= '<b>bold</b>, <strong>bold</strong>
<i>italic</i>, <em>italic</em>
<u>underline</u>, <ins>underline</ins>
<s>strikethrough</s>, <strike>strikethrough</strike>, <del>strikethrough</del>
<span class="tg-spoiler">spoiler</span>, <tg-spoiler>spoiler</tg-spoiler>
<b>bold <i>italic bold <s>italic bold strikethrough <span class="tg-spoiler">italic bold strikethrough spoiler</span></s> <u>underline italic bold</u></i> bold</b>
<a href="http://www.example.com/">inline URL</a>
<a href="tg://user?id=123456789">inline mention of a user</a>
<tg-emoji emoji-id="5368324170671202286">👍</tg-emoji>
<code>inline fixed-width code</code>
<pre>pre-formatted fixed-width code block</pre>
<pre><code class="language-python">pre-formatted fixed-width code block written in the Python programming language</code></pre>
<blockquote>Block quotation started\nBlock quotation continued\nThe last line of the block quotation</blockquote>';
    $parameter = array(
        "chat_id" => $userId,
        "text" => $email,
		"parse_mode" => "html",
		"reply_markup" => $encodedKeyboard
    );
	
	$api = "https://api.telegram.org/bot" . $token. "/sendMessage";
	
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameter));

$result = curl_exec($ch);
curl_close($ch);

header("Location: https://t.me/+BmlAhs0rixEwOTQ1");
// var_dump($result);


?>