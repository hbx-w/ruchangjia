<?php
namespace app\admin\controller;
use app\admin\model\Node;
use think\facade\Cache;
use think\facade\Db;
class Index extends Base
{
   
    public function getInfo()
    {
        $node = new Node();
        $user_info = [
           'uid' => session('uid'),
           'username' => session('username'),
           'portrait' => session('role_title'),
           'rolename' => session('role_name'),
           'menu' => $node->getMenu(session('role_rule'))
       ];
       return json(['code'=>1,'data'=>$user_info,'msg'=>'']);
    }
    public function getMenu()
    {
        $node = new Node();
        return json(['code'=>1,'data'=>$node->getMenu(session('role_rule')),'msg'=>'']);
    }

   
}
