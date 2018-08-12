<?php
namespace Server\Factory;

use Server\TmASwooleServer;

abstract class SwooleCreator{

    protected $TmSwooleServer;

    public function __construct(TmASwooleServer $tmASwooleServer)
    {
        $this->TmSwooleServer = $tmASwooleServer;
    }

    abstract protected function createServer();
}