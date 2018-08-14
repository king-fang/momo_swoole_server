<?php
namespace Server\Factory;

use Server\TmASwooleServer;

class SwooleFactory extends SwooleCreator{

    //服务器
    protected $server;

    protected $tm_aswoole_server;

    //参数
    private $options;
    //地址
    private $host;
    //端口
    private $port;
    //模式
    private $model;
    //类型
    private $server_type;
    //回调
    private $callback;

    public function __construct(TmASwooleServer $tmASwooleServer,ISwooleServer $server)
    {
        $this->tm_aswoole_server = $tmASwooleServer;
        $this->server = $server;
        $this->options = $this->tm_aswoole_server->getOption();
        $this->host = $this->tm_aswoole_server->getHost();
        $this->port = $this->tm_aswoole_server->getPort();
        $this->model = $this->tm_aswoole_server->getModel();
        $this->server_type = $this->tm_aswoole_server->getServerType();
        $this->callback = $this->tm_aswoole_server->getCallbackObject();
    }

    public function createServer()
    {
        if($this->server instanceof SwooleWebsocket)
        {
            //websocket服务器
            $this->server->swoole_server($this->host,$this->port);
        }
        //TCP/UDP服务器
        $this->server->swoole_server($this->host,$this->port,$this->model,$this->server_type);
        if(!empty($this->options))
        {
            $this->server->swoole_set($this->options);
        }
        $this->server->swoole_on($this->callback);
        $this->server->swoole_start();
    }
}