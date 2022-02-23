<?php
namespace app\admin\controller;

use think\facade\Db;

class Ruzhu extends Base{
    public function index()
    {
         $map = [];
         $keyword = input('param.keyword');
         $map[] = ['nickname','like','%'.$keyword.'%'];
         $Nowpage = input('get.page')?input('get.page'):1;
         $limits = input('get.limit',10);
         $count = Db::name('member')->where($map)->count();
         $allPage = intval(ceil($count/$limits));
         $lists = Db::name('member')->where($map)->page($Nowpage,$limits)->order('id asc')->select();
         return json(['code'=>1,'data'=>['lists'=>$lists,'count'=>$count],'msg'=>'']);
    }
}
?>