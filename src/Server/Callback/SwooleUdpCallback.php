<?php
namespace Server\Callback;

class SwooleUdpCallback extends SwooleCallback implements ISwooleUdpCallback{

    private $server;

    public function __construct($server = null)
    {
        $this->server = $server;
    }

    public function onPacket($serv, $data, $clientInfo)
    {
        $serv->sendto($clientInfo['address'], $clientInfo['port'], "Server ".$data);
        var_dump($clientInfo);
    }

    public function __toString()
    {
        return __CLASS__;
    }
}