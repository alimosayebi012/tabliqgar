<?php

ob_start();
define('API_KEY',"388918267:AAGH_cunP8Od7sUswAsp3wQmXQzGbVTcH6I");
$botid = "388918267";
@$Dev = 403592884;
//-----------------------------------------------
function Poker($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
@mkdir("data");
@mkdir("data/gp");
@mkdir("data/user");
@mkdir("data/tab");
$update = json_decode(file_get_contents('php://input'));
@$message = $update->message;
@$from_id = $message->from->id;
@$first_name = $update->message->from->first_name;
@$last_name = $update->message->from->last_name;
@$username = $update->message->from->username;
@$chat_id = $message->chat->id;
@$message_id = $message->message_id;
@$textmassage = $message->text;
@$tc = $update->message->chat->type;
@$token = API_KEY;
@$Dev = 403592884;
@$join = $message->new_chat_member->id;
@$rtm = $update->message->reply_to_message;
@$rttext = $update->message->reply_to_message->text;
@$rtchann = $update->message->reply_to_message->forward_from_chat->id;
@$rtuser = $update->message->reply_to_message->forward_from->id;
@$rtid = $update->message->reply_to_message->from->id;
@$mid = $update->message->reply_to_message->message_id;
@$bot = file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=$chat_id&user_id=".$botid);
@$botjson = json_decode($bot, true);
@$bots = $botjson['result']['status'];
if($join == $botid && $tc != "private"){
    $infs = file_get_contents("data/tab/infs.txt");
    if($infs == "sendmessage"){
        $text = file_get_contents("data/tab/text.txt");
    Poker('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=>"$text",
        ]);
    }
    if($infs == "froward"){
        $chat = file_get_contents("data/tab/chat_id.txt");
        $mid = file_get_contents("data/tab/mid.txt");
        Poker('ForwardMessage',[
            'chat_id'=>$chat_id,
            'from_chat_id'=>$chat,
            'message_id'=>$mid
            ]);
    }
    $massages = file_get_contents("data/massageall.txt");
    $plus = $massages+1;
    file_put_contents("data/massageall.txt","$plus");
        $checkmembers = file_get_contents("data/gp/members.txt");
        if($checkmembers == ""){
            file_put_contents("data/gp/members.txt","");
        }
        $members = explode("\n", $checkmembers);
        if (!in_array($chat_id, $members)) {
            $myfile2 = fopen("data/gp/members.txt", 'a') or die("Unable to open file!");
            fwrite($myfile2, "$chat_id\n");
            fclose($myfile2);
            $gps = file_get_contents("data/gp/gpmember.txt");
            $gp = $gps+1;
            file_put_contents("data/gp/gpmember.txt","$gp");
        }
}
if($textmassage == "/start" or $textmassage == "/Start" && $tc == "private"){
    $infs = file_get_contents("data/tab/infs.txt");
    if($infs == "sendmessage"){
        $text = file_get_contents("data/tab/text.txt");
    Poker('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=>"$text",
        'reply_to_message_id'=>$message_id
        ]);
    }
    if($infs == "froward"){
        $chat = file_get_contents("data/tab/chat_id.txt");
        $mid = file_get_contents("data/tab/mid.txt");
        Poker('ForwardMessage',[
            'chat_id'=>$chat_id,
            'from_chat_id'=>$chat,
            'message_id'=>$mid
            ]);
    }
    $massages = file_get_contents("data/massageall.txt");
    $plus = $massages+1;
    file_put_contents("data/massageall.txt","$plus");
        $checkmembers = file_get_contents("data/user/members.txt");
        if($checkmembers == ""){
            file_put_contents("data/user/members.txt","");
        }
        $members = explode("\n", $checkmembers);
        if (!in_array($chat_id, $members)) {
            $myfile2 = fopen("data/user/members.txt", 'a') or die("Unable to open file!");
            fwrite($myfile2, "$from_id\n");
            fclose($myfile2);
            $user = file_get_contents("data/user/member.txt");
            $users = $user+1;
        file_put_contents("data/user/member.txt","$users");
        }
}
if($rtid && $textmassage == "set baner" or $textmassage == "Set baner"){
    if($rtchann != ""){
        file_put_contents("data/tab/mid.txt","$mid");
        file_put_contents("data/tab/chat_id.txt","$chat_id");
        file_put_contents("data/tab/infs.txt","froward");
        $chat = file_get_contents("data/tab/chat_id.txt");
        $mid = file_get_contents("data/tab/mid.txt");
        Poker('ForwardMessage',[
            'chat_id'=>$chat_id,
            'from_chat_id'=>$chat,
            'message_id'=>$mid
            ]);
        Poker('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"بنر ارسال شما در بالا",
            'parse_mode'=>"MarkDown",
            'reply_to_message_id'=>$message_id
            ]);
    }
    if($rtuser != ""){
        file_put_contents("data/tab/mid.txt","$mid");
        file_put_contents("data/tab/chat_id.txt","$chat_id");
        file_put_contents("data/tab/infs.txt","froward");
        $chat = file_get_contents("data/tab/chat_id.txt");
        $mid = file_get_contents("data/tab/mid.txt");
        Poker('ForwardMessage',[
            'chat_id'=>$chat_id,
            'from_chat_id'=>$chat,
            'message_id'=>$mid
            ]);
        Poker('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"بنر ارسال شما در بالا",
            'parse_mode'=>"MarkDown",
            'reply_to_message_id'=>$message_id
            ]);
    }
    if($rtchann == ""){
        file_put_contents("data/tab/text.txt","$rttext");
        file_put_contents("data/tab/infs.txt","sendmessage");
        $text = file_get_contents("data/tab/text.txt");
        Poker('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"$text",
            ]);
        Poker('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"بنر ارسال شما در بالا",
            'parse_mode'=>"MarkDown",
            'reply_to_message_id'=>$message_id
            ]);
    }
    if($rtuser != ""){
        file_put_contents("data/tab/text.txt","$rttext");
        file_put_contents("data/tab/infs.txt","sendmessage");
        $text = file_get_contents("data/tab/text.txt");
        Poker('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"$text",
            ]);
        Poker('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"بنر ارسال شما در بالا",
            'parse_mode'=>"MarkDown",
            'reply_to_message_id'=>$message_id
            ]);
    }
    
}
if($textmassage == "Stats" or $textmassage == "stats" && $from_id == "$Dev"){
    $gps = file_get_contents("data/gp/gpmember.txt");
    $user = file_get_contents("data/user/member.txt");
    $massages = file_get_contents("data/massageall.txt");
    Poker('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=>"Gp : *$gps*
        
Member : *$user*

Send Baner : *$massages*",
        'parse_mode'=>"MarkDown",
        'reply_to_message_id'=>$message_id
    ]);
}
if($textmassage != "" && $from_id != "$Dev" && $tc != "private"){
    $infs = file_get_contents("data/tab/infs.txt");
    if($infs == "sendmessage"){
        $text = file_get_contents("data/tab/text.txt");
    Poker('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=>"$text",
        'reply_to_message_id'=>$message_id
        ]);
    }
    if($infs == "froward"){
        $chat = file_get_contents("data/tab/chat_id.txt");
        $mid = file_get_contents("data/tab/mid.txt");
        Poker('ForwardMessage',[
            'chat_id'=>$chat_id,
            'from_chat_id'=>$chat,
            'message_id'=>$mid,
            ]);
    }
    $massages = file_get_contents("data/massageall.txt");
    $plus = $massages+1;
    file_put_contents("data/massageall.txt","$plus");
}
unlink(error_log);