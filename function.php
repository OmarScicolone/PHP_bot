<?php

function sendMessage($id, $text, $keyboard){
	if (isset($keyboard)){
    	$strkeyb = '&reply_markup={"inline_keyboard":['.$keyboard.']}';
    }
	$url = $GLOBALS[website]."/sendMessage?chat_id=$id&parse_mode=HTML&text=".urlencode($text).$strkeyb;
    file_get_contents($url);
}

function editMessageText($id, $messageid, $text, $keyboard){
	if (isset($keyboard)){
    	$strkeyb = '&reply_markup={"inline_keyboard":['.$keyboard.']}';
    }
	$url = $GLOBALS[website]."/editMessageText?chat_id=$id&message_id=$messageid&parse_mode=HTML&text=".urlencode($text).$strkeyb;
	file_get_contents($url);
}

function forwardMessage($id, $fromid, $messageid){
	$url = $GLOBALS[website]."/forwardMessage?chat_id=$id&from_chat_id=$fromid&message_id=$messageid";
	file_get_contents($url);
}

function sendAudio($id, $audio){
	$url = $GLOBALS[website]."/sendAudio?chat_id=$id&audio=$audio&parse_mode=HTML";
    file_get_contents($url);
}


?>