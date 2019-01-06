<?php
use Ratchet\Server\IoServer;
use Ratchet\MessageNotification;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;


require './vendor/autoload.php';

$server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new MessageNotification()
                )
            ),
            8080);

$server->run();
