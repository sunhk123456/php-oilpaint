<?php


namespace app\admin\validate;


use think\Validate;

class Login extends Validate
{
protected  $rule=[
    'uname'=>'require',
    'upassword'=>'require',
    'oldpass'=>'require',
    'newpass'=>'require',
    'newpassagain'=>'require|confirm:newpass'

];
protected  $message=[
    'username'=>'用户名必填',
    'upassword'=>'密码必填',
    'oldpass'=>'原密码必填',
    'newpass'=>'新密码必填',
    'newpassagain.require'=>'确认密码必填',
    'newpassagain.confirm'=>'确认密码必须和新密码保持一致',
];
    protected $scene =[
        'check'=>'uname,upassword',
        'update'=>'newpass,oldpass,newpassagain',

    ];
}