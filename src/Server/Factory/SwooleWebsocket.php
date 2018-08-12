<?php
namespace Server\Factory;

use Server\TmASwooleServer;

class SwooleWebsocket implements ISwooleServer {

    private $option;
    private $host;
    private $port;
    private $callback;

    public function __construct(TmASwooleServer $server)
    {
        $this->option = $server->getOption();
        $this->host = $server->getHost();
        $this->port = $server->getPort();
        $this->callback = $server->getCallbackObject();
    }

    public function swoole_servers()
    {
        $server = new \swoole_websocket_server($this->host, $this->port);
        $server->on('open',array($this->callback, 'onOpen'));
        $server->on('message',array($this->callback, 'onMessage'));
        $server->on('close',array($this->callback, 'onClose'));
        $server->start();
        return true;
    }
}