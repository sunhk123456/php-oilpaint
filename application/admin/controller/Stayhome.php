<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;
use think\Validate;

class Stayhome extends Controller
{


    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public $code;
    public $validate;
    public function __construct(Request $request = null)
    {

        parent::__construct($request);
        $this->code=config('code');
        $this->validate=validate('Stayhome');

    }

    public function index()
    {

        $data=$this->request->get();
        //分页

        if (isset($data['page'])&&!empty($data['page'])){
            $page=$data['page'];
        }else{
            $page=1;
        }
        if (isset($data['limit'])&&!empty($data['limit'])){
            $limit=$data['limit'];
        }else{
            $limit=10;//写到配置项
        }

        //处理搜索条件
        $where=[];
        if (isset($data['scity'])&&!empty($data['scity'])){
            $where['scity']=$data['scity'];
        }

        if (isset($data['sname'])&&!empty($data['sname'])){
            $where['sname']=['like','%'. $data['sname'].'%'];

        }
//        ->field('sid,sname.sdesc,sprice,stag,sthumb,sprovice,scity,sarea,ctime')
       $result= Db::table('stayhome') ->field('sid,sname,sdesc,sprice,stag,sthumb,scity,sarea,score,ctime,sprovince')->where($where)->paginate($limit,false,['page'=>$page]);
        $stayhome = $result->items();
        $total=$result->total();
        if ($stayhome&&$total) {
            return json([
                'code' => 200,
                'msg' => '查看成功',
                'data'=>$stayhome,
                'total'=>$total
            ]);
        } else {
            return json([
                'code' => 200,
                'msg' => '暂无此页面',
            ]);


        }
//        echo "nihao";
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
       $result= Db::table('stayhome')->insert($data);
        if ( $result){
            return json([
                'code'=>$this->code['success'],
            'msg'=>'数据添加成功'
            ]);
        }else{
            return json([
                'code'=>$this->code['fail'],
                'msg'=>'数据添加失败'
            ]);
        }
//        config('code.success');
//        validate('stayhome');
//        echo "save";
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
        //
        $result= Db::table('stayhome')->where('sid',$id)->find();
        return json([
           'code'=>200,
        'msg'=>'查询到数据',
        'data'=>$result,
        ]);
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



        $data=$this->request->param();

        unset($data["id"]);
        $result=  Db::table('stayhome')->update($data["params"]);
        if ($result) {
            return json([
                'code' => 200,
                'msg' => '更改成功'
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '数据库更改失败'
            ]);
        }

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