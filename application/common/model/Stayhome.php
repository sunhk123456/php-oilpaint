<?php


namespace app\common\model;


use think\Model;

class Stayhome extends Model
{
    protected $autoWriteTimestamp = false;

    public function queryOne($where, $filed = 'sid,sname,sthumb,scity,sarea,sdesc')
    {
        return $this->field($filed)->where($where)->select();
    }
    public function edit($data,$where){
        return $this->isUpdate(true)->save($data,$where);
    }
    public function find($where){
        return $this->where($where)->find();
    }

}