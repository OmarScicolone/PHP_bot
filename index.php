<?php
include "function.php";
include "variables.php";
include "config.php";


$filepointer = fopen('users', "r+");
$filename = 'users';
//qui prendiamo gli utenti da $filename
$users = file_get_contents($filename);
$users = json_decode($users, true);
if($users["$id"]["registered"] != true){
	$users["$id"]["registered"] = true;
    $users["$id"]["username"] = $username;
	$users = json_encode($users);
	file_put_contents($filename, $users);
    }


if ($message == "/start"){
  sendMessage($id, "Hi $name \xF0\x9F\xA5\x81 \nWhat can this bot do?\n
  ▹ Check the complete catalog by clicking on the button below\n
  ▹ Check out all the artists available by clicking on the button below\n
  ▹ Type in the name of a song to check if it is in the database\n
  ▹ Type in an artist name to check which of his songs are in the database\n
  ▹ You can suggest a song to add by clicking on the button below. In the new chat write Artist - Title\n
  ▹ N.B: The first time you ask for a song in the catalog, it may take a few more seconds and not be immediate\n
  ▹ If you have any advice of any kind to improve the bot, use the 'Suggest a song' button ", $main_keyboard2);
  exit();
}

if ($cqdata == "start"){
  editMessageText($cqid, $cqmsgid, "Hi \xF0\x9F\xA5\x81 \nWhat can this bot do?\n
  ▹ Check the complete catalog by clicking on the button below\n
  ▹ Check out all the artists available by clicking on the button below\n
  ▹ Type in the name of a song to check if it is in the database\n
  ▹ Type in an artist name to check which of his songs are in the database\n
  ▹ You can suggest a song to add by clicking on the button below. In the new chat write Artist - Title\n
  ▹ N.B: The first time you ask for a song in the catalog, it may take a few more seconds and not be immediate\n
  ▹ If you have any advice of any kind to improve the bot, use the 'Suggest a song' button ", $main_keyboard2);
  exit();
}

if($cqdata == 'catalog'){
    $Search = mysql_query("SELECT * FROM `Tracks` ORDER BY `Tracks`.`Artist` ASC");
    $msg = "";
    while($tmp = mysql_fetch_assoc($Search)){
    	$artist = ▹." ".$tmp["Artist"];
        $title = $tmp["Title"];
        $Link = $tmp["Link"];
        
        //$url = $GLOBALS[website]."/sendAudio?chat_id=$cqid&audio=$Link&parse_mode=HTML"; //corretto, con i link strani
        //$msg = $msg."$artist - <a href='$url'>$title</a>;\n";
        
        //$msg = $msg."$artist - <a href='$Link'>$title</a>;\n"; corretto, con i link
        
        $msg = $msg."$artist - <pre>$title</pre>\n"; //corretto, senza link
    }
    
    editMessageText($cqid, $cqmsgid, "<b>Available Tracks:</b>\n$msg\nYou can just tap the name of the song to copy the title and then send it to chat", $main_keyboard);
    exit();
}

if($cqdata == 'artist'){
    $Search = mysql_query("SELECT DISTINCT `Artist` FROM `Tracks` ORDER BY `Tracks`.`Artist` ASC");
    $msg = "";
    while($tmp = mysql_fetch_assoc($Search)){
	$artist = $tmp["Artist"];
        $msg = $msg.▹." "."<pre>$artist</pre>\n";
    }
    editMessageText($cqid, $cqmsgid, "<b>Available Artists:</b>\n$msg\nYou can just tap the artist name to copy it and then send it in chat", $main_keyboard);
    exit();
}

if($cqdata == 'info'){
    editMessageText($cqid, $cqmsgid, "This bot was created entirely by me, a guy with two passions, programming and drum.\nThe bot is and will be completely free. If you want to help me (there is a lot of work behind it and I am just a student ...) here is the Paypal link: https://paypal.me/OmarScicolone \nThanks to everyone who contributed \xF0\x9F\x92\x93 \n(If you donate, don't forget to enter a message)\n
    Josh - 2$ - 'Thanks bro'
    Luca - 0.50€ - 'Deserved'", $main_keyboard);
    exit();
}

$Search = mysql_query("SELECT * FROM `Tracks` WHERE `Title` LIKE '$message'");
$Song = mysql_fetch_assoc($Search);
$Link = $Song["Link"];
if(!empty($Link))
	$CT = TRUE;
//se link non vuoto invierà una canzone quindi flag
sendAudio($id, "$Link");

//$Search = mysql_query("SELECT * FROM `Tracks` WHERE `Artist` LIKE '$message'");
//$Song = mysql_fetch_assoc($Search);
//$Artist = $Song["Artist"];
$Search2 = mysql_query("SELECT * FROM `Tracks` WHERE `Artist` LIKE '$message'");
while($tmp = mysql_fetch_assoc($Search2)){
    	$SongByArtist = $tmp["Title"];
        $msg = $msg.▹." "."<pre>$SongByArtist</pre>\n";
        $CUA = TRUE; //Cercato un artista
        //se entra qua dentro fare un flag da usare subito fuori
    }
if($CUA)
	sendMessage($id, "<b>Available Songs by $message:</b>\n$msg\nYou can just tap the name of the song to copy the title and then send it to chat", $main_keyboard);
else{
	if($CT)
		sendMessage($id, "What do you want to do?", $main_keyboard);
    else
    	sendMessage($id, "Artist/Song not present in the database.\nWhat do you want to do?", $main_keyboard);
}


?>