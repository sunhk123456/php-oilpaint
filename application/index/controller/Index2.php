<?php


namespace app\admin\controller;





use think\Controller;
use think\Db;
use think\Request;


class Index extends Controller
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
        //轮播图
        $banner = [];
        //数据
        $category=[];
        //获取轮播图
        $banner=Db::table("stayhome")->field("sid,sname,sthumb")->order("sid","desc")->select();
        //获取种类信息
        $category=Db::table("category")->field("cname,cid,cdesc")->order("cid","desc")->limit(0,4)->select();

        for ($i=0,$count=count($category);$i<$count;$i++){
            $cid =$category[$i]["cid"];
            $stayhome=Db::table("stayhome")->field("sname,sdesc,sbanner,sprice,stag")->order("sid","desc")->where("cid",$cid)->limit(0,4)->select();
            $category[$i]['children']=$stayhome;
        }
        return json([
            "code"=>$this->code['success'],
            "msg"=>"成功",
            "banner"=>$banner,
            "category"=>$category
        ]);
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
        //
        echo "save";
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
