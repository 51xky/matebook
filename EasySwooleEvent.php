<?php
namespace EasySwoole\EasySwoole;


use App\Spider\ConsumeTest;
use App\Spider\ProductTest;
use EasySwoole\EasySwoole\Swoole\EventRegister;
use EasySwoole\EasySwoole\AbstractInterface\Event;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use EasySwoole\Spider\Config\SpiderConfig;
use EasySwoole\Spider\SpiderServer;

class EasySwooleEvent implements Event
{

    public static function initialize()
    {
        // TODO: Implement initialize() method.
        date_default_timezone_set('Asia/Shanghai');
    }

    public static function mainServerCreate(EventRegister $register)
    {
        /*################# tcp 服务器1 没有处理粘包 #####################
        $tcp1ventRegister = $subPort1 = ServerManager::getInstance()->addServer('tcp1', 9502, SWOOLE_TCP, '0.0.0.0', [
            'open_length_check' => false,//不验证数据包
        ]);
        $tcp1ventRegister->set(EventRegister::onConnect,function (\swoole_server $server, int $fd, int $reactor_id) {
            echo "tcp服务1  fd:{$fd} 已连接\n";
            $str = '恭喜你连接成功服务器1';
            $server->send($fd, $str);
        });
        $tcp1ventRegister->set(EventRegister::onClose,function (\swoole_server $server, int $fd, int $reactor_id) {
            echo "tcp服务1  fd:{$fd} 已关闭\n";
        });
        $tcp1ventRegister->set(EventRegister::onReceive,function (\swoole_server $server, int $fd, int $reactor_id, string $data) {
            echo "tcp服务1  fd:{$fd} 发送消息:{$data}\n";
        });

        // 当工作进程开启时，调用；dev中配置workerNum=8
        $register->add($register::onWorkerStart,function (\swoole_server $server,int $workerId){
            var_dump($workerId.'start');
        });*/
    }

    public static function onRequest(Request $request, Response $response): bool
    {
        // TODO: Implement onRequest() method.
        return true;
    }

    public static function afterRequest(Request $request, Response $response): void
    {
        // TODO: Implement afterAction() method.
    }
}