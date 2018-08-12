<?php
namespace Server\Factory;


class SwooleWebsocketFactory extends SwooleCreator{


    public function createServer()
    {
        $websocket = new SwooleWebsocket($this->TmSwooleServer);
        return $websocket->swoole_servers();
    }
}