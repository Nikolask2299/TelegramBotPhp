<?php
define('TGKEY', '7472898032:AAG_YrQQlyWzkdC3LA6YosOAJ9kAFn399SI');
define('WEBHOK', 'YOU ARE WEBHOK');

include('tg.class.php');
include('postgres_db.php');

$tg = new TGBot (TGKEY);
if ($tg != null) {
    echo 'Telegram Bot connected';
} else {
    echo 'Telegram Bot not connected';
    exit();
}

$db = new PostgresDB('postgres', 'postgres_admin', 'q1w2e3r4t5y6u7i8o9p0');
if ($db != null) {
    echo 'Postgres DB connected';
} else {
    echo 'Postgres DB not connected';
    exit();
}

$tg -> deleteWebhook();
$tg->setWebhook(WEBHOK);
$tg -> getWebhookinfo();

$body = file_get_contents('php://input');
$data = json_decode($body, true);


if ($body != '') {
    $chat_id = $data['message']['chat']['id'];
    $ms_text = $data['message']['text'];
    $user_id = $data['message']['from']['id'];
    switch ($ms_text) {
        case '/start':
            $db -> createScore($user_id);
            $score = $db -> getScore($user_id);
            $tg -> sendMessage($chat_id, 'Ваш счет: ' . $score);
        default:
            $ms_text = strtr($ms_text, ',' , '.');
            $db -> updateScore($user_id, $ms_text);
            $score = $db -> getScore($user_id);
            $tg -> sendMessage($chat_id, 'Ваш счет: ' . $score);
    }
}

exit('ok'); 
