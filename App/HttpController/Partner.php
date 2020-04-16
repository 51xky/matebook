<?php


namespace App\HttpController;


use EasySwoole\Http\AbstractInterface\Controller;

class Partner extends Controller
{

    function index()
    {
        // TODO: Implement index() method.
        $model = new \App\Models\Partner();
        $data = $model->schemaInfo()->getColumns();
        return $this->writeJson(200,$data,'成功');
    }

    function show()
    {
        $id = $this->request()->getAttribute('id');
        return $this->writeJson(200,$id);
        $res = \App\Models\Partner::create()->get($id);
        return $this->writeJson(200,$res);
    }

    function add()
    {
        $res = \App\Models\Partner::create([
          'name'=>'testc5',
          'password'=>'123456',
          'real_name'=>'xky'
        ])->save();
        return $this->writeJson(200,$res);
    }

    function update()
    {
        $res = \App\Models\Partner::create()->get(3682)
            ->update(['real_name'=>'xky2']);
        return $this->writeJson(200,$res);
    }
}