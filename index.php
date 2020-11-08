<?php
ob_start();
define('API_KEY','708339207:AAF0J7_0YjR1RhEtaI0ZWn-XHJXvqbjAlmo');
$mybot="@DaysandBoxTM_Bot";
function bot($method,$datas=[]){
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

$update = json_decode(file_get_contents('php://input'));
$efede = json_decode(file_get_contents('php://input'), true);
$message = $update->message;
$text = $message->text;
$vaqt=date('H:i', strtotime('2 hour'));
$bugun = date('d-M Y', strtotime('2 hour'));
$kanal = "@UzStarTM";
$token = "878353408:AAEk8J5FelMZZlY0H2qsHH2LdtHHEXinQaE";
$title = $message->chat->title;
$chat_id = $message->chat->id;
$mid = $message->message_id;
$type = $message->chat->type;
$chatuser = $message->chat->username;
$data = $update->callback_query->data;
$qid = $update->callback_query->id;
$chat_id2 = $update->callback_query->message->chat->id;
$user_id2 = $update->callback_query->from->id;
$mid2 = $update->callback_query->message->message_id;
$ufname = $update->message->from->first_name;
$uname = $update->message->from->last_name;
$username = $update->message->from->username;
$user_id = $update->message->from->id;
$replytx = $message->reply_to_message->text;
$edit = $message->edited_message->text;
mkdir('UzStarTM');
$capt = $message->caption;
$newid = $message->new_chat_member->id;
$is_bot = $message->new_chat_member->is_bot;
$rekname = file_get_contents("UzStarTM/RekName.matn");
$reklink = file_get_contents("UzStarTM/RekLink.matn");
$step = file_get_contents("UzStarTM/$chat_id.step");
$azolar = file_get_contents("azo.dat");
$good = $json->ok;

$mem = bot('getChatMembersCount',[
'chat_id'=>$chat_id,
]);
$azo = $mem->result;

$getlink = file_get_contents("https://api.telegram.org/bot$token/exportChatInviteLink?chat_id=$chat_id");
$jsonlink = json_decode($getlink, true);
$getlinkde = $jsonlink['result'];
if($chatuser){
$result = "@$chatuser";
}else{
$result = "$getlinkde";
}

//<---------A'zolatni ro'yhatga olish------->//
if(isset($message)){
   $baza=file_get_contents("azo.dat");
   if(mb_stripos($baza,$chat_id) !==false){
   }else{
   $textt="\n$chat_id";
   $file=fopen("azo.dat","a");
   fwrite($file,$textt);
   fclose($file);
   }
}
//<----------Asosiy bo'lim---------->//

if ($type == "supergroup" or $type == "group"){
if((isset($message->forward_from) or isset($message->forward_from_chat)!==false) or (stripos($text,"@") !==false)  or (stripos($text,"t.me")!==false) or (stripos($text,"telegram.me")!==false) or (stripos($text,"http://")!==false) or (stripos($text,"https://")!==false) or (stripos($capt,"http://telegram.me")!==false) or (stripos($capt,"https://t.me")!==false) or (stripos($text,"telegram.dog")!==false) or (stripos($capt,"telegram.dog")!==false)  or (stripos($capt,"telegram.me")!==false) or (stripos($capt,"t.me")!==false) or (stripos($capt,"@")!==false) or (stripos($capt,"@")!==false) or (stripos($capt,"@")!==false) or (stripos($text,"@")!==false)){
 $gett = bot('getChatMember', [
   'chat_id' => $chat_id,
   'user_id' => $user_id,
   ]);
  $get = $gett->result->status;
  if($get =="member"){
bot('deletemessage',[
'chat_id'=>$chat_id,
'message_id'=>$mid,
]);
bot ('SendMessage',[
"chat_id"=> $chat_id,
'text'=>"‼️<a href='tg://user?id=$user_id'>$ufname</a> <b>Reklama tarqatmang!</b> ",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>$rekname,'url'=>$reklink]],
] 
]) 
]);
}}}

$kanali="@UzStarTM";
$chpost = $update->channel_post;
$chuser = $chpost->chat->username;
$chpmesid = $chpost->message_id;
$chcaption = $chpost->caption;
$chm = file_get_contents("news.txt");

if(isset($chpmesid) and (strtolower($chuser) == strtolower(str_replace("@","",$kanali)))){
unlink("news.dat");
file_put_contents("news.txt",$chpmesid);
$chm = file_get_contents("news.txt");
bot('forwardMessage', [
'chat_id'=>$admin,
'from_chat_id'=>$kanali,
'message_id'=>$chm,
]);
}
if(mb_stripos($text,"/start")!==false){
bot('forwardMessage', [ 
'chat_id'=>$chat_id,
'from_chat_id'=>$kanali,
'message_id'=>$chm,
    ]); 
} 
if ($newid == "878353408"){
bot('forwardMessage', [ 
'chat_id'=>$chat_id,
'from_chat_id'=>$kanali,
'message_id'=>$chm,
    ]); 
bot ('SendMessage', [
'chat_id'=>$adminkanal,
'text'=>"✅$mybot <b>Guruhga qo'shishdi:</b>

🔸<i>Guruh nomi:</i> <b>$title</b>
👥<i>Guruh a'zolar soni:</i> <b>$azo ta</b>
▫️<i>Guruh:</i> $result",
'parse_mode'=>"html",
'disable_web_page_preview'=>true,
]);
}
  if($text == '/file' and $chat_id == $admin){
bot('sendDocument',[
'chat_id'=>$chat_id,
'document'=>new CURLFile(__FILE__),
'caption'=>"$mybot php code! n 🕜Olingan vaqti $bugun $vaqt",
]);
bot('sendDocument',[
'chat_id'=>$chat_id,
'document'=>new CURLFile("azo.dat"),
'caption'=>"$mybot id toplami! n 🕜Olingan vaqti $bugun $vaqt",
]);
}

if($text=="/stat" or $text=="/stat@DaySandBoxBot" and $user_id==$admin){
      $all=substr_count($azolar,"\n");
      $gr=substr_count($azolar,"-");
      $us=$all-$gr;
      $text = "<b>📊Statistika
📡Botdan foydalanayotgan
👥Guruhlar:</b> <b>$gr</b> <b>ta
👤Userlar:</b> <b>$us</b> <b>ta
♻️Hammasi bo'lib:</b> <b>$all</b> <b>ta

🕜Vaqti: $bugun $vaqt</b>";
  bot('sendmessage',[
   'chat_id'=>$chat_id,
   'parse_mode'=>'html',
   'text'=>$text,
'reply_markup'=>json_encode([ 
            'inline_keyboard'=>[ 
                [['text'=>$rekname,'url'=>$reklink]],
            ] 
        ]) 
    ]); 
} 

if($text == "/rek" and $chat_id == $admin){
bot('sendMessage',[
'chat_id'=>$chat_id,
'parse_mode'=>"markdown",
'text'=>"❇️*Bot Reklamasi Matnini yuboring!*",
]);
file_put_contents("UzStarTM/$chat_id.step","rekname");
}

if($step == "rekname" and $chat_id == $admin){
file_put_contents("UzStarTM/$chat_id.step","RekLink");
file_put_contents("UzStarTM/RekName.matn",$text);
bot('sendmessage',[
'chat_id'=>$admin,
'parse_mode'=>"markdown",
'text'=>"✅*Reklama Matni saqlani! Endi linkni yuboring!*",
]);      
}
if($step == "RekLink" and $chat_id == $admin){
file_put_contents("UzStarTM/RekLink.matn",$text);
bot('sendmessage',[
'chat_id'=>$admin,
'parse_mode'=>"markdown",
'text'=>"✅*Reklama Linki va Matni o'rnatildi!*
[$rekname]($reklink)",
'disable_web_page_preview' => true,
]);      
unlink("UzStarTM/$chat_id.step");
}

if($text == "🔵Forward" and $chat_id == $admin){
file_put_contents("UzStarTM/$chat_id.step", "fd");
bot('sendmessage', [
'chat_id' => $chat_id,
'text' => "Xabaringizni yuboring",
'reply_to_message_id'=>$mid,
'reply_markup'=>$key
]);} 
if($step == 'fd') {
file_put_contents("UzStarTM/$chat_id.step", "no");
$forp = fopen("azo.dat", 'r');
while (!feof($forp)) {
$fakar = fgets($forp);
bot('forwardMessage', [
'chat_id'=>$fakar,
'from_chat_id'=>$chat_id,
'message_id'=>$mid,
]);
}
bot('sendMessage', [
'chat_id' => $chat_id,
'text' => "Xabar yuborildi",
'reply_to_message_id'=>$mid,
]);}
//<----------@DaySandBoxTM_Bot 1.7 versia kodi! Kod @UzStarsGroup kanali oqali tarqatildi ---------->// 

//<----------Kirdi Chiqdilarni ochirish bolimi---------->// 
if(isset($update->message->new_chat_member) or isset($update->message->new_chat_photo) or isset($update->message->new_chat_title) or isset($update->message->left_chat_member) or isset($update->message->pinned_message)){
    bot('deleteMessage',[
        'chat_id'=>$chat_id,
        'message_id'=>$mid,
    ]);
}