<?php
namespace Server\Callback;

class SwooleWebsocketCallback extends SwooleCallback implements ISwooleWebsocketCallback {

    public function onOpen($server, $request){
        echo "server: handshake success with fd{$request->fd}\n";
    }

    public function onMessage($server, $frame){
        echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
        $server->push($frame->fd, "this is server");
    }

    public function onClose($server,$fd){
        echo "client {$fd} closed\n";
    }
}
