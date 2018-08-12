<?php
namespace Server;


use Server\Callback\ISwooleCallback;

abstract class TmASwooleServer {

    //默认IP/域名
    protected  $host = '127.0.0.1';

    //默认端口
    protected  $port = '9501';

    //服务器类型
    protected  $server_type = ['tcp' => SWOOLE_SOCK_TCP,'udp' => SWOOLE_SOCK_UDP,'websocket' => 'websocket'];

    //服务器运行模式
    protected  $model = ['base'=>SWOOLE_BASE,'process'=>SWOOLE_PROCESS];

    //服务器资源句柄
    protected  $server;

    //配置参数
    protected $option = [];

    //回调函数对象
    protected  $callback_object;

    //server factory
    protected $server_factory;


    public function ServerStart()
    {
        $classname = ($this->server_type == 1 ? 'tcp' : $this->server_type == 2 ? 'udp' : 'websocket').'Server';
        $this->$classname();
        $this->server_factory->createServer();
    }

    abstract protected function setOption(array $options);

    abstract protected function callback(ISwooleCallback $callback);

    abstract protected function tcpServer();

    abstract protected function udpServer();

    abstract protected function websocketServer();
}