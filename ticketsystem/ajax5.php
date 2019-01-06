<?php
require'autoload.php';

$latestID = $_GET["value"];

$message = new Message();

$result = $message->leseMessage($latestID);
foreach ($result as $post){
    
    
    
    $ArrayMessageContents[] = array(
        "absender" =>$post['absender'],
        "nachricht" => $post['inhalt'],
        "message_zeit" => $post['message_zeit'],
       "message_id" => strval($post['message_id'])
    );
    
}

print_r(json_encode($ArrayMessageContents));