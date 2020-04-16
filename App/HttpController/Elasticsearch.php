<?php


namespace App\HttpController;


use EasySwoole\Http\AbstractInterface\Controller;

class Elasticsearch extends Controller
{

    function index()
    {
        // TODO: Implement index() method.
        $config = new \EasySwoole\ElasticSearch\Config([
            'host'          => 'localhost',
            'port'          => 9200
        ]);

        $elasticsearch = new \EasySwoole\ElasticSearch\ElasticSearch($config);
        $bean = new \EasySwoole\ElasticSearch\RequestBean\Search();
        $bean->setIndex('test');
        $bean->setType('my_type');
        $bean->setBody(['query' => ['matchAll' => []]]);
        $response = $elasticsearch->client()->search($bean)->getBody();
        $client = $elasticsearch->client();
        var_dump($client);

        /*go(function()use($elasticsearch){
            $bean = new \EasySwoole\ElasticSearch\RequestBean\Search();
            $bean->setIndex('my_index');
            $bean->setType('my_type');
            $bean->setBody(['query' => ['matchAll' => []]]);
            $response = $elasticsearch->client()->search($bean)->getBody();
            return $this->writeJson(200,$response);
            var_dump(json_decode($response, true));
        });*/
    }

    function insertOne()
    {
        $config = new \EasySwoole\ElasticSearch\Config([
            'host'          => '127.0.0.1',
            'port'          => 9200
        ]);

        $elasticsearch = new \EasySwoole\ElasticSearch\ElasticSearch($config);

        go(function()use($elasticsearch){
            $bean = new \EasySwoole\ElasticSearch\RequestBean\Create();
            $bean->setIndex('test');
            $bean->setType('my_type');
            $bean->setId('my_id2');
            $bean->setBody(['test_field' => 'test_data']);
            $response = $elasticsearch->client()->create($bean)->getBody();
            $response = json_decode($response,true);
            var_dump($response);
//            return $this->writeJson(200,1);
//            return $this->writeJson(200,$response);
//            var_dump($response['result']);
        });
    }

    function select()
    {
        $config = new \EasySwoole\ElasticSearch\Config([
            'host'          => '127.0.0.1',
            'port'          => 9200
        ]);

        $elasticsearch = new \EasySwoole\ElasticSearch\ElasticSearch($config);

        go(function()use($elasticsearch){
            $bean = new \EasySwoole\ElasticSearch\RequestBean\Get();
            $bean->setIndex('test');
            $bean->setType('my-type');
            $bean->setId('my-id');
            $response = $elasticsearch->client()->get($bean)->getBody();
            var_dump(json_decode($response, true));
        });
    }
}