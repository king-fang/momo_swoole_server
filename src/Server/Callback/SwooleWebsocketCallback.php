<?php
namespace Server\Callback;
//https://wiki.swoole.com/wiki/page/803.html
class SwooleWebsocketCallback  implements ISwooleWebsocketCallback {

    private $server;

    public function __construct($server = null)
    {
        $this->server = $server;
    }

    public function onOpen($server, $request){
        echo "server: handshake success with fd{$request->fd}\n";
    }

    public function onMessage($server, $frame){
        echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
        $server->push($frame->fd, "this is server:".$frame->data);
    }

    public function onClose($server,$fd){
        echo "client {$fd} closed\n";
    }

    public function onRequest(\swoole_http_request $request, \swoole_http_response $response)
    {
        $response->end("<h1>Hello Swoole. #".rand(1000, 9999)."</h1>");
    }
}
