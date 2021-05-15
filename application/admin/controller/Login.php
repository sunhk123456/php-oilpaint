<?php


namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\JWT;

class Login extends Controller
{
    /*
     * 1.验证权限
     * 2.验证请求方式
     * 3.接收前台发送数据
     * 4.前台数据验证
     * 5.业务逻辑
     *
     * */
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub

    }

    public function check()
    {
        $method = $this->request->method();
        if ($method != 'POST') {
            return json([
                'code' => 404,
                'msg' => '请求错误'
            ]);
        }
        $data = $this->request->param();
        $validate = validate('Login');
        $flag = $validate->scene('check')->check($data);

        if (!$flag) {
            return json([
                'code' => 404,
                'msg' => $validate->getError()
            ]);
        }
        $whereArr = ['uname' => $data['uname']];
        $user = Db::table('admin')->where($whereArr)->find();
        if ($user) {
            $upassword = md5(crypt($data['upassword'], config('salt')));
            if ($upassword == $user['upassword']) {
                $payload = [
                    'id' => $user['id'],
                    'username' => $user['uname'],
                    'avater' => $user['avatar'],
                ];
                $token = JWT::getToken($payload, config('jwtkey'));
                return json([
                    'code' => 200,
                    'msg' => '登录成功',
                    'token' => $token,
                    'user' => $payload,
                ]);
            } else {
                return json([
                    'code' => 404,
                    'msg' => '用户名和密码不匹配'
                ]);
            }

        } else {
            return json([
                'code' => 404,
                'msg' => '用户名不存在'
            ]);
        }
    }

    /*
     * 传入四个数据
     * 1 旧密码 oldpass
     * 2.新密码 newpass
     * 3.确认两个密码一样  newpassagain
     * 4.用户的Id
     * */
    public function updatepassword()
    {
        checkToken();
        if(!$this->request->isPost()){
            return json([
                'code' => 404,
                'msg' => '请求错误'
            ]);
        }
        $data = $this->request->param();
        $validate = validate('Login');
        $flag = $validate->scene('update')->check($data);
        if (!$flag) {
            return json([
                'code' => 404,
                'msg' =>$validate->getError()
            ]);
        }
        $id=   $this->request->id;
        if ($data['newpass'] != $data['newpassagain']) {
            return json([
                'code' => 404,
                'msg' => '两次密码输入不一致'
            ]);
        }
        $password = Db::table('admin')->field('upassword')->where('id', $id)->find();
//        var_dump($password);
        $oldpassword = secrectPassword($data['oldpass']);
        $newpassword = secrectPassword($data['newpass']);

      if ($newpassword==$oldpassword){

          return json([
              'code' => 404,
              'msg' => '旧密码与新密码一样'
          ]);
      }

//        echo "密码匹配成功";
      if ($oldpassword==$password['upassword']){


          $result = Db::table('admin')->where('id', $id)->update(['upassword'=> $newpassword]);

          if ($result) {
              return json([
                  'code' => 200,
                  'msg' => '修改密码成功',

              ]);
          }

      }else{
          return json([
              'code' => 404,
              'msg' => '修改密码失败',

          ]);
      }
    }
}