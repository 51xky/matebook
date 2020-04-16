<?php
namespace EasySwoole\EasySwoole;


use EasySwoole\EasySwoole\Swoole\EventRegister;
use EasySwoole\EasySwoole\AbstractInterface\Event;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use EasySwoole\ORM\Db\Connection;
use EasySwoole\ORM\DbManager;

class EasySwooleEvent implements Event
{

    public static function initialize()
    {
        // TODO: Implement initialize() method.
        date_default_timezone_set('Asia/Shanghai');
    }

    public static function mainServerCreate(EventRegister $register)
    {
        $config = (new \EasySwoole\ORM\Db\Config())
            ->setDatabase('ekp')
            ->setUser('root')
            ->setPassword('root')
            ->setHost('localhost')
            ->setPort('3306')
            ->setCharset('utf8')
            ->setTimeout(10)
            ->setFetchMode(false)// fetch类型
            ->setStrictType(false)// 严格模式
            ->setExtraConf([])// 额外配置值
            ->setIntervalCheckTime(3)// 连接池检测间隔
            ->setGetObjectTimeout(3.0)// 连接池的超时时间
            ->setMaxIdleTime(15)// 连接池最大闲置时间
            ->setMaxObjectNum(20)// 连接池最大数量
            ->setMinObjectNum(5);// 连接池最小数量
        DbManager::getInstance()->addConnection(new Connection($config));

        // 配置同上别忘了添加要检视的目录
        $hotReloadOptions = new \EasySwoole\HotReload\HotReloadOptions();
        $hotReload = new \EasySwoole\HotReload\HotReload($hotReloadOptions);
        $hotReloadOptions->setMonitorFolder([EASYSWOOLE_ROOT . '/App']);

        $server = ServerManager::getInstance()->getSwooleServer();
        $hotReload->attachToServer($server);


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