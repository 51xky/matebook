<?php


namespace App\HttpController;


use App\Model\Admin\AdminModel;
use App\Spider\ProductTest;
use EasySwoole\EasySwoole\ServerManager;
use EasySwoole\FastCache\Cache;
use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Spider\SpiderClient;

class Index extends Controller
{
    function index()
    {
        /*$p = new Xky();
        $this->response()->write('asslllj');

        $words = [
            'php',
            'java',
            'go'
        ];

        foreach ($words as $word) {
            Cache::getInstance()->enQueue('SEARCH_WORDS', $word);
        }

        $wd = Cache::getInstance()->deQueue('SEARCH_WORDS');

        SpiderClient::getInstance()->addJob(
            'https://www.baidu.com/s?wd=php&pn=0',
            [
                'page' => 1,
                'word' => $wd
            ]
        );
//        $am = new AdminModel();
//        $this->response()->write('1');*/
        $file = EASYSWOOLE_ROOT.'/vendor/easyswoole/easyswoole/src/Resource/Http/welcome.html';
        if(!is_file($file)){
            $file = EASYSWOOLE_ROOT.'/src/Resource/Http/welcome.html';
        }
        $this->response()->write(file_get_contents($file));
    }

    protected function actionNotFound(?string $action)
    {
        $this->response()->withStatus(404);
        $file = EASYSWOOLE_ROOT.'/vendor/easyswoole/easyswoole/src/Resource/Http/404.html';
        if(!is_file($file)){
            $file = EASYSWOOLE_ROOT.'/src/Resource/Http/404.html';
        }
        $this->response()->write(file_get_contents($file));
    }

    function push(){
        $fd = intval($this->request()->getRequestParam('fd'));
        $info = ServerManager::getInstance()->getSwooleServer()->connection_info($fd);
        if(is_array($info)){
            ServerManager::getInstance()->getSwooleServer()->send($fd,'push in http at '.time());
        }else{
            $this->response()->write("fd {$fd} not exist");
        }
    }
}