<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Index extends Controller
{
    public function index()
    {

  echo     md5(crypt( config('defaltPassword'),config('salt')) ) ;
  exit();
        $student=  Db::table("admin")->select();
        return json([
            'code'=>200,
            'msg'=>'success',
            'data'=>$student
        ]);

    }
    public function  lists(){
      $student=  Db::table("admin")->select();
//        $student=  Db::table("admin")->find();
        $data=['name'=>"zhangsanss",'age'=>12];
        $url=['html','css','a'];
        $this->assign("names","zhangsan");

        $this->assign("data",$data);
//        $this->assign("student",$student);
        $this->assign("student",$student);
        $this->assign("url",$url);
//        echo $student['uname'];
//        exit();
//        var_dump($student);
//        exit();
      return $this->fetch();

    }
}

