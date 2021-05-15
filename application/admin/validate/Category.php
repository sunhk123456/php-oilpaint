<?php


namespace app\admin\validate;


use think\Validate;

class Category extends Validate
{
protected $rule=[
    'cid'=>'require|number',
    'cname'=>'require|chsAlphaNum',
    'cdesc'=>'require|chsAlphaNum'


];
    protected $message =[
        'cid.require'=>'cid必传',
        'cid.number'=>'cid只能是数字',
        'cname.require'=>'分类名称必填',
        'cname.chsAlphaNum'=>'只能包含汉字字母',
        'cdesc.require'=>'分类名称必填',
        'cdesc.chsAlphaNum'=>'只能包含汉字字母',
    ];
protected $scene =[
  'add'=>'cname,cdesc',
  'read'=>'cid',
    'edit'=>'cname,cdesc,cid'
];

}