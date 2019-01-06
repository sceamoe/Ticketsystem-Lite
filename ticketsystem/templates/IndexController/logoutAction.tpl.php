<?php
$session = new Session();
$passwort = $session->getSessionName(USER_PASSW_VAR);

$session_handler = new MysqlSessionHandler();
$session_handler->deleteSessionRanOff($session_id);

$auth = new Auth($db,'index.php' , $passwort);

echo 'Schluss f�r heute!';
$auth->logout('index.php');

