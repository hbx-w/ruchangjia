<?php
 namespace app\admin\controller;

use think\exception\ValidateException;
use think\facade\Db;
use think\facade\Filesystem;

 class User extends Base{
     public function index()
     {
         $map = [];
         $keyword = input('param.keyword');
         $map[] = ['username','like','%'.$keyword.'%'];
         $Nowpage = input('get.page')?input('get.page'):1;
         $limits = input('get.limit',10);
         $count = Db::name('admin')->where($map)->count();
         $lists = Db::name('admin')->where($map)->page($Nowpage,$limits)->order('id asc')->select();
         return json(['code'=>1,'data'=>['lists'=>$lists,'count'=>$count],'msg'=>'']);
     }
     public function add()
     {
         if(request()->isPost()){
             $param = input('post.');
             try{
                 validate('UserValidate',$param);
             }catch(ValidateException $e){
                 return json(['code'=>0,'msg'=>$e->getError()]);
             }
             $param['create_time']=$param['update_time']=time();
             $flag = Db::name('admin')->save($param);
             if($flag){
                 return json(['code'=>1,'data'=>'','msg'=>'添加成功']);
             }else{
                return json(['code'=>0,'data'=>'','msg'=>'添加失败']);
             }
         }
         return json(['code'=>1,'data'=>'','msg'=>'']);
     }
     public function edit()
     {
         if(request()->isPost()){
             $param = input('post.');
             $id = input('param.id');
             try{
                 validate('UserValidate',$param);
             }catch(ValidateException $e){
                 return json(['code'=>0,'msg'=>$e->getError()]);
             }
             $param['update_time']=time();
             $flag = Db::name('admin')->where(['id'=>$id])->update($param);
             if($flag){
                 return json(['code'=>1,'data'=>'','msg'=>'编辑成功']);
             }else{
                return json(['code'=>0,'data'=>'','msg'=>'编辑失败']);
             }
         }
         $id = input('param.id');
         $res = Db::name('admin')->where(['id'=>$id])->find();
         return json(['code'=>1,'data'=>$res,'msg'=>'']);
     }
     public function del()
     {
         $id = input('param.id');
         $flag = Db::name('admin')->where(['id'=>$id])->delete();
         if($flag){
            return json(['code'=>1,'data'=>'','msg'=>'删除成功']);
        }else{
           return json(['code'=>0,'data'=>'','msg'=>'删除失败']);
        }
     }
     public function state()
     {
         $id = input('param.id');
         $map = ['id'=>$id];
         $status = Db::name('admin')->where($map)->value('status');
         if($status == 1){
             Db::name('admin')->where($map)->update(['status'=>0]);
             return json(['code'=>1,'data'=>'','msg'=>'操作成功']);
         }else{
            Db::name('admin')->where($map)->update(['status'=>1]);
            return json(['code'=>1,'data'=>'','msg'=>'操作成功']);
         }
     }
     //头像上传
     public function upload()
     {
         $file = input('post.image');
         $savename = Filesystem::putFile('topic',$file);
         return json(['code'=>1,'data'=>$savename]);

     }
 }
?>