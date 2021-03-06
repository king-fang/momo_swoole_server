<?php
namespace Server;

use Server\Callback\ISwooleCallback;
use Server\Factory\ISwooleServer;
use Server\Factory\SwooleCreator;
use Server\Factory\SwooleTcpFactory;
use Server\Factory\SwooleUdpFactory;
use Server\Factory\SwooleWebsocketFactory;

class TmSwoolerServer extends TmASwooleServer {

    /**
     * 初始化
     * TmSwoolerServer constructor.
     * @param string $host  IP/域名
     * @param int $port  端口
     * @param string $server_type 服务器类型tcp/udp/websocket
     * @param string $model 运行模式
     * @throws SwooleServerException
     */
    public function __construct(string $host = '' ,int $port = 0 ,string $server_type = 'tcp', string $model = 'process')
    {
        if(!in_array($model,array_keys($this->model)) || !in_array($server_type,array_keys($this->server_type)))
        {
            throw new SwooleServerException('Swoole operation mode or Socket type is incorrect.');
        }
        $this->host  = empty($host) ? $this->host : $host;
        $this->port  = $port == 0 ? $this->port : $port;
        $this->model  = strtolower($this->model[$model]);
        $this->server_type  = strtolower($this->server_type[$server_type]);
    }

    //配置参数
    public function setOption(array $options)
    {
        $this->option = $options;
    }

    //回调
    public function callback(string $callback)
    {
        if(class_exists($callback))
        {
            throw new SwooleServerException("{$callback} not found");
        }
        $this->callback_object = $callback;
    }

    //服务器
    protected function setServer(SwooleCreator $server)
    {
        $this->server_factory = $server;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function getOption()
    {
        return $this->option;
    }

    public function getServerType()
    {
        return $this->server_type;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getCallbackObject(){
        return $this->callback_object;
    }

}