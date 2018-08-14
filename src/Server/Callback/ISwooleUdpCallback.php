<?php
namespace Server\Callback;

interface ISwooleUdpCallback{

    public function onPacket($serv, $data, $clientInfo);
}
