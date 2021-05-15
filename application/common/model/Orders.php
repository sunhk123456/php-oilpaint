<?php


namespace app\common\model;


use think\Model;

class Orders extends Model
{

    protected $autoWriteTimestamp=true;
    public function add($data){
        return $this->allowField(true)->isUpdate(false)->save($data);
    }
    public function updata($where,$data){
        return $this->allowField(true)->isUpdate(true)->save($data,$where);

    }
    public function indexdata($table,$where,$where1,$field='enter_time,leave_time,sarea,scity,sthumb,ostatus,sname,price,oid'){
        return $this->alias('o')->field($field)->where($where)->join($table,$table.'.'.$where1.'='.'o.'.$where1)->select();
    }

}