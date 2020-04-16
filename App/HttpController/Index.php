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
        $config = new \EasySwoole\ElasticSearch\Config([
            'host'          => '127.0.0.1',
            'port'          => 9200
        ]);

        $elasticsearch = new \EasySwoole\ElasticSearch\ElasticSearch($config);

        go(function()use($elasticsearch){
            $bean = new \EasySwoole\ElasticSearch\RequestBean\Create();
            $bean->setIndex('my_index');
            $bean->setType('my_type');
            $bean->setId('my_id');
            $bean->setBody(['test_field' => 'test_data']);
            $response = $elasticsearch->client()->create($bean)->getBody();
            $response = json_decode($response,true);
            var_dump($response['result']);
        });

        go(function()use($elasticsearch){
            $bean = new \EasySwoole\ElasticSearch\RequestBean\Get();
            $bean->setIndex('my-index');
            $bean->setType('my-type');
            $bean->setId('my-id');
            $response = $elasticsearch->client()->get($bean)->getBody();
            var_dump(json_decode($response, true));
        });

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