<?php


namespace App\Models;


use EasySwoole\Annotation\Exception;
use EasySwoole\ORM\AbstractModel;
use EasySwoole\ORM\Utility\Schema\Table;

class Partner extends AbstractModel
{
    public $tableName = 'partners';
    public $autoTimeStamp = 'datetime';
    public $createTime = 'created_at';
    public $updateTime = 'updated_at';
    public $data;

    function __construct(array $data = [])
    {
        $this->data = $data;
        parent::__construct($data);
    }

    /*public function schemaInfo(bool $isCache = true): Table
    {
        $table = new Table($this->tableName);
        $table->colInt('id')->setIsPrimaryKey(true);
        $table->colChar('name', 255);
        $table->colInt('age');
        return $table;
    }*/

    function getId()
    {
        try{
            return random_int(1,30);
        }catch (\Exception $e) {
            return 0;
        }
    }

    function getRate($dividend,$divisor)
    {
        $rate = 0;
        if(!empty($dividend) && !empty($divisor) ){
            return round($dividend / $divisor * 100,2).'%';
        }
        return $rate;
    }

}