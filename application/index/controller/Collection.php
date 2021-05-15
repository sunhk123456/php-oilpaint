<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class collection extends Controller
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);

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
     * @param \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        checkToken1();

        $uid = $this->request->uid;
        $collection = $this->request->post()['data'];
        $model = model('User');
        $where = [
            'uid' => $uid
        ];
        $data['collection'] =$collection;
        $result = $model->queryCollection($where,$data);
        return json([
            'code' => 200,
            'msg' => '成功',
        ]);
        //
    }

    /**
     * 显示指定的资源
     *
     * @param int $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
        $model=model('Stayhome');
        $sid= explode(',',$id);

        $where['sid']  = ['in',$sid];
        $result= $model->queryOne($where);
        return json([
            'code'=>200,
            'data'=>$result
        ]);
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param int $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param \think\Request $request
     * @param int $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param int $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
