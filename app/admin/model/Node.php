<?php

namespace app\admin\model;
use think\Model;
use think\facade\Db;

class Node extends Model
{

    protected $name = "auth_rule";


    /**
     * [getNodeInfo 获取节点数据]
     * @author [田建龙] [864491238@qq.com]
     */
    public function getNodeInfo($id,$tag=false)
    {
        $map=['status'=>1];
        if($tag){
            $map['tag']=0;
        }
        $result = $this->where($map)->field('id,title,pid')->order('sort asc')->select();
        $str = "";
        $role = new UserType();
        $rule = $role->getRuleById($id);
        if(!empty($rule)){
            $rule = explode(',', $rule);
        }

        foreach($result as $key=>$vo){
            $vo['checked']=0;
            if(!empty($rule) && in_array($vo['id'], $rule)){
                $vo['checked']=1;
            }
        }

        return subTree($result);
    }


    /**
     * [getMenu 根据节点数据获取对应的菜单]
     * @author [田建龙] [864491238@qq.com]
     */
    public function getMenu($shop_id,$nodeStr = [])
    {
        if($shop_id && empty($nodeStr)){
            return '';
        }
        //超级管理员没有节点数组
        $where = empty($nodeStr) ? 'status = 1' : 'status = 1 and id in('.implode(',',$nodeStr).')';
        $map=[];
        if($shop_id != 0){
            $map['tag']=0;
        }
        $result = Db::name('auth_rule')->where($where)->where($map)->order('sort asc')->select();
        $menu = prepareMenu($result);
        return $menu;
    }
}