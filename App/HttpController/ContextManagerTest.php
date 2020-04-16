<?php


namespace App\HttpController;


use EasySwoole\Component\Context\ContextManager;
use EasySwoole\Http\AbstractInterface\Controller;

class ContextManagerTest extends Controller
{

    function index()
    {
        // TODO: Implement index() method.
        go(function (){
            ContextManager::getInstance()->set('key','key in parent');
            go(function (){
                ContextManager::getInstance()->set('key','key in sub');
                var_dump(ContextManager::getInstance()->get('key')." in");
            });
            \co::sleep(1);// 携程sleep
            var_dump(ContextManager::getInstance()->get('key')." out");
            ContextManager::getInstance()->registerItemHandler('');
        });
    }

}