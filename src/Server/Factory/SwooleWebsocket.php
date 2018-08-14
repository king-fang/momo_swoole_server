<?php
namespace Server\Factory;


use Server\Callback\SwooleWebsocketCallback;
use Server\SwooleServerException;

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
        $class = new $callback($this->websocket);
        if($class instanceof SwooleWebsocketCallback)
        {
            $this->websocket->on('open',array($class, 'onOpen'));
            $this->websocket->on('message',array($class, 'onMessage'));
            $this->websocket->on('close',array($class, 'onClose'));
            //设置了onRequest回调，websocket服务器也可以同时作为http服务器
            //未设置onRequest回调，websocket服务器收到http请求后会返回http 400错误页面
            $this->websocket->on('request',array($class, 'onRequest'));
        }else{
            throw  new SwooleServerException("{$class} not instance of ".new SwooleWebsocketCallback());
        }

    }

    public function swoole_start()
    {
        return $this->websocket->start();
    }
}