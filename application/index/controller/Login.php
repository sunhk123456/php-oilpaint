<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\JWT;
use think\Request;

class Login extends Controller
{
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

        $result=$model->queryOne(['uusername'=>$data['username']]);
        if ($result){
            if ($data['password'] ==$result['upassword']){
                $paylod=[
                    'uname'=>$result['uname'],
                    'username'=>$result['uusername'],
                ];
                $token=JWT::getToken($paylod,config('jwtkey'));
                return json([
                    'code'=>200,
                    'msg'=>'成功',
                    'data'=>$result,
                    'token'=>$token,
//                'collection'=> $result['collection'],
                ]);
            }else{
                return json([
                    'code'=>400,
                    'msg'=>'密码错误',

                ]);
            }

        }else{
            return json([
                'code'=>400,
                'msg'=>'失败',

            ]);
        }


    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
//        $data=$this->request->param();
//        $model=model('User');
//        $result=$model->queryOne(['phone'=>$id]);
//
//        return json([
//            'code'=>200,
//            'msg'=>'成功',
//            'collection'=>$result['collection']
//        ]);
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
