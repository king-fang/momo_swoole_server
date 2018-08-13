<?php
namespace Server\Factory;

interface ISwooleServer {

    //设置服务器句柄
    public function swoole_server(string $host,int $port,string $model=null,$sock_type = null);

    //配置参数
    public function swoole_set(array $option = []);

    //回调对象
    public function swoole_on($callback);

    //启动
    public function swoole_start();
}