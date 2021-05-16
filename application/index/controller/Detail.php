<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Exception;
use think\Request;

class Detail extends Controller
{
    public $code;
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $this->code=config('code');
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
        echo "222";
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $model=model('Detail');

        $result=$model->find(['did'=>$id]);
        $colors= Db::table('colors')->where('did',$id)->select();
        $imgs= Db::table('imgs')->where('did',$id)->select();
        $comments= Db::table('comments')->where('did',$id)->select();
        $cms= Db::table('cms')->where('did',$id)->select();
        $desc= Db::table('desc')->where('did',$id)->select();
        $detailNavTab= Db::table('detailnavtab')->where('did',$id)->select();
        $userCommons= Db::table('usercommons')->where('did',$id)->select();
        $result['colors']=$colors;
        $result['imgs']=$imgs;
        $result['comments']=$comments;
        $result['cms']=$cms;
        $result['desc']=$desc;
        $result['detailNavTab']=$detailNavTab;
        $result['userCommons']=$userCommons;


        if ($result){

            return json([

                'code'=>$this->code['success'],
                'msg'=>'成功',
                'data'=>$result,
            ]);
        }else{
            return json([

                'code'=>$this->code['fail'],
                'msg'=>'数据获取失败',
                '$id'=>$id,

            ]);
        }


//        try{
//            $stayhome= Db::table('stayhome')->where('sid',$id)->find();
//            if($stayhome){
//                $recommend=Db::table("stayhome")->where('sid','<>',$id)->field("sid,sname,sthumb,sprice,score,scity,sarea")->order('sid','desc')->limit(0,4)->select();
//                return json([
//                    'code'=>$this->code['success'],
//                    'msg'=>'数据获取成功',
//                    'data'=>[
//                        'stayhome'=>$stayhome,
//                        'recommend'=>$recommend
//                    ]
//
//                ]);
//            }else{
//                return json([
//                    'code'=>$this->code['fail'],
//                    'msg'=>'数据获取失败',
//
//                ]);
//            }
//        }catch (Exception $exception){
//            return json([
//                'code'=>404,
//                'msg'=>"服务器错误"
//            ]);
//        }


        //

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
