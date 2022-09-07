<?php
$token = '1637443991:AAF1vdzPS9q_dtLaCFN_bsHh1wC6VIAIv5Q';
$website = 'https://api.telegram.org/bot'.$token;


$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);

$message = $update['message']['text'];
$id = $update['message']['from']['id'];
$name = $update['message']['from']['first_name'];
$username = $update['message']['from']['username'];


$cq = $update['callback_query'];
$cqdata = $cq['data'];
$cqid = $cq['from']['id'];
$cqmsgid = $cq['message']['message_id'];


$main_keyboard2 = '[{"text":"'.urlencode("Catalog (It's a quite long message... \xF0\x9F\x98\x81)").'","callback_data":"catalog"}],[{"text":"'.urlencode("Search by artist \xF0\x9F\x8E\xA4").'","callback_data":"artist"}],[{"text":"'.urlencode("Suggest a song \xF0\x9F\x8E\xB5").'","url":"https://t.me/OmarScic"}],[{"text":"'.urlencode("Info \xE2\x84\xB9").'","callback_data":"info"}]';
$main_keyboard = '[{"text":"'.urlencode("Start \xF0\x9F\x94\x80").'","callback_data":"start"}],[{"text":"'.urlencode("Catalog (It's a long message... \xF0\x9F\x98\x81)").'","callback_data":"catalog"}],[{"text":"'.urlencode("Search by Artist \xF0\x9F\x8E\xA4").'","callback_data":"artist"}],[{"text":"'.urlencode("Suggest a song \xF0\x9F\x8E\xB5").'","url":"https://t.me/OmarScic"}],[{"text":"'.urlencode("Info \xE2\x84\xB9").'","callback_data":"info"}]';
?>