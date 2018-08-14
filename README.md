# momo_swoole_server
![Swoole](https://www.swoole.com/static/files/swoole-logo.svg)
# websocket/http/tcp/upd
1. websocket服务器也可以同时作为http服务器，设置了onRequest回调即可,默认开启
2. 自定义的回调类必须是继承*SwooleCallback*和实现对应的接口
3. 回调接口：*ISwooleUdpCallback*,*ISwooleWebsocketCallback*,*ISwooleCallback*
4. 当前服务器的*server*可以通过构造函数在回调的构造函数中获取*__construct($server)* 获取,将其设置为成员属性即可

#Start
```
/**
 * 初始化
 * TmSwoolerServer constructor.
 * @param string $host  IP/域名
 * @param int $port  端口
 * @param string $server_type 服务器类型tcp/udp/websocket
 * @param string $model 运行模式
 */
$client = new \Server\TmSwoolerServer('127.0.0.1',9502,'websocket');

//设置参数
$client->setOption(array(
    'reactor_num' => 2,
    'worker_num' => 4,
    'backlog' => 128,
    'max_request' => 50,
    'dispatch_mode' => 1,
));
//设置回调
$client->callback(\Server\Callback\SwooleWebsocketCallback::class);
//启动
$client->ServerStart();
```