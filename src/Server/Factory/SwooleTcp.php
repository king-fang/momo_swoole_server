<?php
namespace Server\Factory;


use Server\Callback\SwooleCallback;
use Server\SwooleServerException;

class SwooleTcp implements ISwooleServer {

    private $tcp;

    public function swoole_server(string $host, int $port, string $model = null, $sock_type = null)
    {
        $this->tcp = new \swoole_server($host,$port,$model,$sock_type);
    }

    public function swoole_set(array $option = [])
    {
        $this->tcp->set($option);
    }

    public function swoole_on($callback)
    {
        $class = new $callback($this->tcp);
        if($class instanceof SwooleCallback)
        {
            $this->tcp->on('connect',array($class, 'onConnect'));
            $this->tcp->on('receive',array($class, 'onReceive'));
            $this->tcp->on('close',array($class, 'onClose'));
        }else{
            throw  new SwooleServerException("{$class} must instanceof {SwooleCallback}");
        }
    }

    public function swoole_start()
    {
        $this->tcp->start();
    }
}