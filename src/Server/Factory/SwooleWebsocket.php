<?php
namespace Server\Factory;


class SwooleWebsocket implements ISwooleServer {

    private $websocket;

    public function swoole_server(string $host, int $port, string $model = null, $sock_type = null)
    {
        $this->websocket = new \swoole_websocket_server($host, $port);
    }

    public function swoole_set(array $option = [])
    {
        $this->websocket->set($option);
    }


    public function swoole_on($callback)
    {
        $this->websocket->on('open',array($callback, 'onOpen'));
        $this->websocket->on('message',array($callback, 'onMessage'));
        $this->websocket->on('close',array($callback, 'onClose'));
    }

    public function swoole_start()
    {
        $this->websocket->start();
    }
}