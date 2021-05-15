<?php


namespace app\common\model;


use think\Model;

class User extends Model
{
    protected $table='User';
    protected $autoWriteTimestamp=true;
    public function add($data){
       return $this->allowField(true)->save($data);
    }
    public function queryOne($where,$field='uid,upassword,uname,uusername,cat,collection'){
        return $this->field($field)->where($where)->find();
    }
    public function queryCollection($where,$data,$field='collection'){
        return $this->allowField(true)->save($data,$where);
    }
}