<?php


namespace app\admin\controller;


use think\Controller;
use think\Db;

class Category extends Controller
{
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        checkToken();
    }

    public function add()
    {
        //1.权限
        if (!$this->request->isPost()) {
            return json([
                'code' => 404,
                'msg' => '错误'
            ]);
        }
        $data = $this->request->param();
        $validate = validate('Category');
        if (!$validate->scene('add')->check($data)) {
            return json([
                'code' => 404,
                'msg' => $validate->getError()
            ]);
        }
        $result = Db::table('category')->insert($data);
        if ($result) {
            return json([
                'code' => 200,
                'msg' => '添加成功'
            ]);
        } else {
            return json([
                'code' => 404,
                'msg' => '数据库添加失败'
            ]);
        }
    }

    /**
     * 查看数据，分页、搜索
     */
    public function index()
    {
        $data = $this->request->get();
        if (isset($data['page']) && !empty($data['page'])) {
            $page = $data['page'];

        } else {
            $page = 1;
        }
        if (isset($data['limit']) && !empty($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = 5;
        }
        $where = [];
        if (isset($data['cname']) && !empty($data['cname'])) {
            $where['cname'] = ['like', '%' . $data['cname'] . '%'];
        }
        $category = Db::table('category')->field('cid,cname,cdesc')->where($where)->page($page)->limit($limit)->select();

        $count = Db::table('category')->where($where)->count();
        if ($category && $count) {
            return json([
                'code' => 200,
                'msg' => '数据获取成功',
                'data' => $category,
                'total' => $count,
            ]);
        } else {
            return json([
                'code' => 200,
                'msg' => '暂无此页面',
            ]);


        }
    }
    /*
     * 查询所有数据
     * */
    public function indexall()
    {

        $category = Db::table('category')->field('cid,cname')->select();


        if ($category ) {
            return json([
                'code' => 200,
                'msg' => '数据获取成功',
                'data'=>$category,

            ]);
        } else {
            return json([
                'code' => 200,
                'msg' => '暂无此页面',
            ]);


        }
    }
    /*
     * 编辑
     * */
    public function edit(){
        //1.权限
        $data=$this->request->post();
        $validate = validate('Category');
        if (!$validate->scene('edit')->check($data)) {
            return json([
                'code' => 404,
                'msg' => $validate->getError()
            ]);
        }


//        $result=  Db::table('category')->where('cid', $data['cid'])->update(['cname' => $data['cname'],'cdesc'=>$data['cdesc']]);
        /*
         * $cid=$data['cid'];
         * unset($data['cid'];
         *  $result=  Db::table('category')->where('cid', $data['cid'])->update($data);
         * */
        $result=  Db::table('category')->update($data);
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
    }
    public function read(){
        $data=$this->request->get();

        $validate = validate('Category');
        if (!$validate->scene('read')->check($data)) {
            return json([
                'code' => 404,
                'msg' => $validate->getError()
            ]);
        }
        $category= Db::table('category')->where('cid',$data['cid'])->find();
        if ($category) {
            return json([
                'code' => 200,
                'msg' => '查看成功',
                'data'=>$category,
            ]);
        } else {
            return json([
                'code' => 200,
                'msg' => '暂无此页面',
            ]);


        }

    }
    public function del()
    {
        $data=$this->request->param();
        if ($data['cid']) {
            $cid = $data['cid'];
        } else {
            return json(['code' => 200,
                'msg' => '无此数据',]);
        }
        $result = Db::table('category')->where('cid',$cid)->delete();


        if($result){
            return json([
                'code' => 200,
                'msg' => '删除成功',
                'data' => $result,
            ]);
        }else {
            return json([
                'code' => 200,
                'msg' => '删除失败',
            ]);
        }
    }
    }
