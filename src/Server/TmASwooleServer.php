<?php
/*
|--------------------------------------------------------------------------
| Swoole TCP/UDP/WEBSOCKET Server
|--------------------------------------------------------------------------

/https://wiki.swoole.com
*/
namespace Server;

use Server\Callback\ISwooleCallback;
use Server\Factory\ISwooleServer;
use Server\Factory\SwooleCreator;
use Server\Factory\SwooleFactory;
use Server\Factory\SwooleTcp;
use Server\Factory\SwooleUdp;
use Server\Factory\SwooleWebsocket;

abstract class TmASwooleServer {

    //默认IP/域名
    protected  $host = '127.0.0.1';

    //默认端口
    protected  $port = '9501';

    //服务器类型
    protected  $server_type = ['tcp' => SWOOLE_SOCK_TCP,'udp' => SWOOLE_SOCK_UDP,'websocket'=>3];

    //服务器运行模式
    protected  $model = ['base'=>SWOOLE_BASE,'process'=>SWOOLE_PROCESS];

    //服务器工厂资源句柄
    protected  $server_factory;

    //配置参数
    protected $option = [];

    //回调函数对象
    protected  $callback_object;

    //工厂对象
    protected $server_factory_class = [
        1 => SwooleTcp::class,
        2 => SwooleUdp::class,
        3 => SwooleWebsocket::class,
    ];

    //启动服务器
    public function ServerStart()
    {
        $class = $this->server_factory_class[$this->server_type];
        if(!class_exists($class))
        {
            throw  new SwooleServerException("{$class} does not exist.");
        }
        $this->setServer(new SwooleFactory($this,new $class));
        //工厂接手创建TCP/UDP/WEBSOCKET服务器
        $this->server_factory->createServer();
    }

    /**
     * swoole 配置参数设置
     * @param array $options
     * @return mixed
     */
    abstract protected function setOption(array $options);

    /**
     * 服务器回调对象
     * @param string $callback 回调函数命名空间
     * @return mixed
     */
    abstract protected function callback(string $callback);

    /**
     * TCP/UDP/WEBSOCKET
     * @return mixed
     */
    abstract protected function setServer(SwooleCreator $server);
}