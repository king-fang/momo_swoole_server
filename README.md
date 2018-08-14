# momo_swoole_server
server

```angular2html
$client = new \Server\TmSwoolerServer('0.0.0.0',9502,'websocket');

//设置参数
$client->setOption(array(
    'reactor_num' => 2,
    'worker_num' => 4,
    'backlog' => 128,
    'max_request' => 50,
    'dispatch_mode' => 1,
));
//设置回调
$client->callback(new \Server\Callback\SwooleWebsocketCallback());
//启动
$client->ServerStart();
```