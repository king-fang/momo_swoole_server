<?php
namespace Server\Callback;

class SwooleCallback  implements ISwooleCallback {

    public function onConnect($serv, $fd)
    {
        // TODO: Implement onConnect() method.
    }

    public function onReceive($serv, $fd, $from_id, $data)
    {
        // TODO: Implement onReceive() method.
    }

    public function onClose($serv, $fd)
    {
        // TODO: Implement onClose() method.
    }
}
