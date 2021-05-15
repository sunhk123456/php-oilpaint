<?php


namespace app\admin\controller;


class Upload
{
    public function index(){
       $file = request()->file('file');
        // 移动到框架应用根目录/public/uploads/ 目录下

        if($file){
//            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            $info = $file->validate(['size'=>500*1024,'ext'=>'jpg,png,jpeg,webp'])->move(ROOT_PATH . 'public' . DS . 'uploads');

            if($info){
                $img=date('Ymd'). "/".$info->getFilename();
                $imgURL="/think/public/uploads/".$img;
                return json([
                    'code'=>200,
                    'imgURL'=>$imgURL
                ]);
            }else{
                // 上传失败获取错误信息
                echo $file->getError();
            }
        }
    }
}