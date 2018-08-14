<?php
namespace Server\Factory;

use Server\Callback\SwooleUdpCallback;
use Server\SwooleServerException;

class SwooleUdp implements ISwooleServer {

    
    private $udp;

    public function swoole_server(string $host, int $port, string $model = null, $sock_type = null)
    {
        $this->udp = new \swoole_server($host,$port,$model,$sock_type);
    }

    public function swoole_set(array $option = [])
    {
        $this->udp->set($option);
    }

    public function swoole_on($callback)
    {
        $class = new $callback($this->udp);
        if($class instanceof SwooleUdpCallback)
        {
            $this->udp->on('packet',array($class,'onPacket'));
        }else{
            throw  new SwooleServerException("{$class} not instance of ".new SwooleUdpCallback());
        }
    }

    public function swoole_start()
    {
        $this->udp->start();
    }
}