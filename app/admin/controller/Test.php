<?php
namespace app\admin\controller;

use think\facade\Db;

class Test extends Base{
    public function index()
    {
      //  $lists=Db::name('room_detalis')->alias('rd')
      //                          ->field('rd.id,room_equipment.equipment')
      //                          ->join('room_equipment_access','room_equipment_access.rd_id=rd.id','left')
      //                          ->join('room_equipment','room_equipment.id=room_equipment_access.equipment_id','left')
      //                          ->select()->toArray();
      // dump($lists);
        // return json($lists);
        // foreach($lists as $k=>$valus){
        //    foreach($valus as $k=>$v ){
        //      if($k == 'equipment'){
        //          echo $v;
        //      }
        //    }
        // }
        // $order_num = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        $user_id = Db::name('member')->where(['real_name'=>'陈晨'])->value('id');
        echo $user_id;
    }
}
?>