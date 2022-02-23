<?php
 namespace app\admin\controller;

use think\exception\ValidateException;
use think\facade\Db;

 class Room extends Base{
     public function index()
     {
         $map = [];
         $keyword = input('param.keyword');
         $map[] = ['type','like','%'.$keyword.'%'];
         $Nowpage = input('get.page')?input('get.page'):1;
         $limits = input('get.limit',10);
         $count = Db::name('room')->where($map)->count();
         $allPage = intval(ceil($count/$limits));
         $lists = Db::name('room')->where($map)->page($Nowpage,$limits)->order('id asc')->select();
         return json(['code'=>1,'data'=>['lists'=>$lists,'count'=>$count],'msg'=>'']);
     }
     public function add()
     {
         if(request()->isPost()){
             $param = input('post.');
             try{
                 validate('RoomValidate',$param);
             }catch(ValidateException $e){
                 return json(['code'=>0,'msg'=>$e->getError()]);
             }
             $param['create_time']=$param['update_time']=time();
             $flag = Db::name('room')->save($param);
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
                 validate('RoomValidate',$param);
             }catch(ValidateException $e){
                 return json(['code'=>0,'msg'=>$e->getError()]);
             }
             $param['update_time']=time();
             $flag = Db::name('room')->where(['id'=>$id])->update($param);
             if($flag){
                 return json(['code'=>1,'data'=>'','msg'=>'编辑成功']);
             }else{
                return json(['code'=>0,'data'=>'','msg'=>'编辑失败']);
             }
         }
         $id = input('param.id');
         $res = Db::name('room')->where(['id'=>$id])->find();
         return json(['code'=>1,'data'=>$res,'msg'=>'']);
     }
     public function del()
     {
         $id = input('param.id');
         $flag = Db::name('room')->where(['id'=>$id])->delete();
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
         $status = Db::name('room')->where($map)->value('status');
         if($status == 1){
             Db::name('room')->where($map)->update(['status'=>0]);
             return json(['code'=>1,'data'=>'','msg'=>'操作成功']);
         }else{
            Db::name('room')->where($map)->update(['status'=>1]);
            return json(['code'=>1,'data'=>'','msg'=>'操作成功']);
         }
     }
    public function room_list()
    {
        $map = [];
        $keyword = input('param.keyword');
        $map[] = ['room_num','like','%'.$keyword.'%'];
        $Nowpage = input('get.page')?input('get.page'):1;
        $limits = input('get.limit',10);
        $count = Db::name('room_detalis')->alias('rd')->where($map)->count();
        $allPage = intval(ceil($count/$limits));
        $lists = Db::name('room_detalis')->alias('rd')->field('rd.*,floor.floor_num,room.type,room_status.room_status')
                                 ->withAttr('create_time',function($value,$data){
                                     return date('Y-m-d H:i:s',$value);
                                 })
                                 ->withAttr('update_time',function($value,$data){
                                    return date('Y-m-d H:i:s',$value);
                                })
                                 ->join('floor','floor.id=rd.f_id','left')
                                 ->join('room','room.id=rd.r_id','left')
                                 ->join('room_status','room_status.id=rd.rs_id')
                                 ->where($map)->page($Nowpage,$limits)->order('id asc')->select()->toArray();
        // $equipment = Db::name('room_detalis')->alias('rd')
        // ->field('room_equipment.equipment')
        // ->join('room_equipment_access','room_equipment_access.rd_id=rd.id','left')
        // ->join('room_equipment','room_equipment.id=room_equipment_access.equipment_id','left')
        // ->select();
        // foreach ($lists as $k => $v) {
        // $lists[$k]['images'] = Db::name('image_gallery')->where(['act_name' => 'room_detalis', 'act_id' => $v['id']])->column('image');
        // }
        return json(['code'=>1,'data'=>['lists'=>$lists,'count'=>$count],'msg'=>'']);
    }
    public function room_add()
    {
        if(request()->isPost()){
            $param = input('post.');
            if(isset($param['file'])){
               unset($param['file']);
            }
            try{
                validate('RoomValidate',$param);
            }catch(ValidateException $e){
                return json(['code'=>0,'msg'=>$e->getError()]);
            }
            $param['create_time']=$param['update_time']=time();
            $flag = Db::name('room_detalis')->save($param);
            if($flag){
                return json(['code'=>1,'data'=>'','msg'=>'添加成功']);
            }else{
               return json(['code'=>0,'data'=>'','msg'=>'添加失败']);
            }
        }
        return json(['code'=>1,'data'=>'','msg'=>'']);
    }
    public function room_edit()
    {
        if(request()->isPost()){
            $param = input('post.');
            $id = input('param.id');
            if(isset($param['file'])){
                unset($param['file']);
             }
            try{
                validate('RoomValidate',$param);
            }catch(ValidateException $e){
                return json(['code'=>0,'msg'=>$e->getError()]);
            }
            $param['update_time']=time();
            $flag = Db::name('room_detalis')->where(['id'=>$id])->update($param);
            if($flag){
                return json(['code'=>1,'data'=>'','msg'=>'编辑成功']);
            }else{
               return json(['code'=>0,'data'=>'','msg'=>'编辑失败']);
            }
        }
        $floor = Db::name('floor')->select();
        $type = Db::name('room')->select();
        $room = Db::name('room_status')->select();
        $equipment = Db::name('room_equipment')->select();
        $id = input('param.id');
        $res = Db::name('room_detalis')->where(['id'=>$id])->find();
        return json(['code'=>1,'data'=>['res'=>$res,'floor'=>$floor,'type'=>$type,'room'=>$room,'equipment'=>$equipment],'msg'=>'']);
    }
    public function room_del()
    {
        $id = input('param.id');
        $flag = Db::name('room_detalis')->where(['id'=>$id])->delete();
        if($flag){
           Db::name('image_gallery')->where(['act_name' => 'room_detalis', 'act_id' => $id])->delete();
           return json(['code'=>1,'data'=>'','msg'=>'删除成功']);
       }else{
          return json(['code'=>0,'data'=>'','msg'=>'删除失败']);
       }
    }
    public function room_state()
    {
        $id = input('param.id');
         $map = ['id'=>$id];
         $status = Db::name('room_detalis')->where($map)->value('status');
         if($status == 1){
             Db::name('room_detalis')->where($map)->update(['status'=>0]);
             return json(['code'=>1,'data'=>'','msg'=>'操作成功']);
         }else{
            Db::name('room_detalis')->where($map)->update(['status'=>1]);
            return json(['code'=>1,'data'=>'','msg'=>'操作成功']);
         }
    }
    public function room_status()
     {
         $lists = Db::name('room_status')->select();
         return json(['code'=>1,'data'=>$lists,'msg'=>'']);
     }
 }
?>