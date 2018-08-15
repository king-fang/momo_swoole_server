<?php
namespace Server\Callback;

class SwooleCallback  implements ISwooleCallback {

    private $server;

    public function __construct($server = null)
    {
        $this->server = $server;
    }

    public function onConnect($serv, $fd)
    {
        echo "Client:Connect.\n";
    }

    public function onReceive($serv, $fd, $from_id, $data)
    {
        $serv->send($fd, 'Swoole: '.$data);
    }

    public function onClose($serv, $fd)
    {
        echo "Client: Close.\n";
    }
}
