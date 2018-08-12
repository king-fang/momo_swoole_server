<?php
namespace Server\Callback;

interface ISwooleWebsocketCallback {

    public function onOpen($server, $request);

    public function onMessage($server, $frame);

}