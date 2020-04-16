<?php


namespace App\HttpController;


use EasySwoole\Http\AbstractInterface\Controller;

/**
 * 定时器测试
 * Class Timer
 * @package App\HttpController
 */
class Timer extends Controller
{

    function index()
    {
        // TODO: Implement index() method.
    }

    function begin()
    {
        $timerId = \EasySwoole\Component\Timer::getInstance()->loop(10 * 1000,function (){
            echo "this timer runs at intervals of 10 seconds\n";
        });
        return $this->writeJson(200,$timerId);
    }

    function after()
    {
        // 10 秒后执行一次
        \EasySwoole\Component\Timer::getInstance()->after(5 * 1000, function () {
            echo "five seconds later\n";
        });
        return $this->writeJson(200,'15s只执行一次');
    }

    function clear()
    {
        $timerId =  $this->request()->getRequestParam('timerId');

        $rst = \EasySwoole\Component\Timer::getInstance()->clear($timerId);
        return $this->writeJson(200,$rst);
    }

}