<?php
require_once '../vendor/autoload.php';

$client = new \Server\TmSwoolerServer('0.0.0.0',9501,'websocket');
$client->setOption(array(
    'reactor_num' => 2,
    'worker_num' => 4,
    'backlog' => 128,
    'max_request' => 50,
    'dispatch_mode' => 1,
));
$client->callback(new \Server\Callback\SwooleWebsocketCallback());
var_dump($client->ServerStart());

