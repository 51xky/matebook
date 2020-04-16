<?php


namespace App\HttpController;


use App\Model\Admin\AdminModel;
use EasySwoole\Component\Di;
use EasySwoole\Http\AbstractInterface\Controller;

class IocTest extends Controller
{

    function index()
    {
        // TODO: Implement index() method.
    }

    function set()
    {
        $di = Di::getInstance();
        $di->set('partner',new \App\Models\Partner());
        $di->set('admin',new AdminModel());
        $di->set('pid',[\App\Models\Partner::class,'getId']);
        $di->set('rate',\App\Models\Partner::class,['10','2o']);

        return $this->writeJson(200,'设置注入');
    }

    function getClass()
    {
        $partner = Di::getInstance()->get('partner');
        return $this->writeJson(200,$partner->getId());
    }

    function getFunction()
    {
        $func = Di::getInstance()->get('pid');
        $pid = call_user_func($func);
        return $this->writeJson(200,$pid);
    }

    function getFunctionParam()
    {
        $partner = Di::getInstance()->get('rate');
        return $this->writeJson(200,$partner->data);
    }

    function delete()
    {
         $di = Di::getInstance();
         $di->delete('partner');
         return $this->writeJson(200,$di);
    }

    function display()
    {
        $di = Di::getInstance();
        var_dump($di);
        return $this->writeJson(200,$di);
    }
}