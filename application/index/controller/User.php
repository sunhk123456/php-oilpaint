<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\JWT;
use think\Model;
use think\Request;

class User extends Controller
{
    public $model;
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->model=model('User');
    }


    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
     {
        $data=$this->request->param();
         $model=model('User');
//            $data['password']=secrectPassword($data['password']);
$param=[
    'upassword'=>$data['password'],
    'uname'=>$data['name'],
    'uusername'=>$data['username']

];
            $result=$model->add($param);

            return json([
                'code'=>200,
                'msg'=>'成功',
                '$data'=>$data,
                'a'=>$param,
                '$result'=>$result
            ]);
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {

        checkToken1();
        $uid=$this->request->uid;
        //
       $result= $this->model->queryOne(['uid'=>$uid],'sex,phone,nickname,avatar,collection');
       if ($result){
           return json([
               'code'=>200,
               'msg'=>'成功',
               'data'=>$result
           ]);
       }else{
           return json([
               'code'=>400,
               'msg'=>'失败',
           ]);
       }
    }
    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
