<?php
namespace Server\Callback;

interface ISwooleCallback {

    public function onConnect($serv, $fd);

    public function onReceive($serv, $fd, $from_id, $data);

    public function onClose($serv, $fd);
}