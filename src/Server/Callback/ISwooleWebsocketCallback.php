<?php
namespace Server\Callback;

interface ISwooleWebsocketCallback {

    public function onOpen($server, $request);

    public function onMessage($server, $frame);

    public function onClose($server,$fd);

    public function onRequest(\swoole_http_request $request, \swoole_http_response $response);

}