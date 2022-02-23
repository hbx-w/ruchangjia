<?php
use think\facade\Db;

/**
 * 将字符解析成数组
 * @param $str
 */
function parseParams($str)
{
    $arrParams = [];
    parse_str(html_entity_decode(urldecode($str)), $arrParams);
    return $arrParams;
}


/**
 * 子孙树 用于菜单整理
 * @param $param
 * @param int $pid
 */
function subTree($param, $pid = 0)
{
    $res = [];
    foreach($param as $key=>$vo){
        if( $pid == $vo['pid'] ){
            $vo['sub']=subTree($param, $vo['id']);
            $res[] = $vo;
        }
    }
    return $res;
}


/**
 * 记录日志
 * @param  [type] $uid         [用户id]
 * @param  [type] $username    [用户名]
 * @param  [type] $description [描述]
 * @param  [type] $status      [状态]
 * @return [type]              [description]
 */
function writelog($uid,$username,$description,$status)
{

    $data['admin_id'] = $uid;
    $data['admin_name'] = $username;
    $data['description'] = $description;
    $data['status'] = $status;
    $data['ip'] = request()->ip();
    $data['add_time'] = time();
    $log = Db::name('Log')->insert($data);

}


/**
 * 整理菜单树方法
 * @param $param
 * @return array
 */
function prepareMenu($param)
{
    $parent = []; //父类
    $child = [];  //子类

    foreach($param as $key=>$vo){

        $vo=[
            'id'=>$vo['id'],
            'name'=>$vo['name'],
            'title'=>$vo['title'],
            'icon'=>$vo['css'],
            'pid'=>$vo['pid'],
        ];
        if($vo['pid'] == 0){
            $vo['jump'] = '#';
            $parent[] = $vo;
        }else{
            $vo['jump'] = $vo['name']; //跳转地址
            $child[] = $vo;
        }
    }

    foreach($parent as $key=>$vo){
        foreach($child as $k=>$v){
            if($v['pid'] == $vo['id']){
                $parent[$key]['list'][] = $v;
            }
        }
    }
    unset($child);
    return $parent;
}


/**
 * 格式化字节大小
 * @param  number $size      字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 */
function format_bytes($size, $delimiter = '') {
    $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
    for ($i = 0; $size >= 1024 && $i < 5; $i++) {
        $size /= 1024;
    }
    return $size . $delimiter . $units[$i];
}

//获取 规格的 笛卡尔积
function combineDika($arr)
{
    $base = current($arr);
    while (next($arr)) {
        $next = current($arr);
        $dika = array();
        foreach ($base as $k => $v) {
            foreach($next as $k1 => $v1) {
                $dika[] = $v . '_' . $v1;
            }
        }
        $base = $dika;
    }
    return $base;
}

function serialize51($value){
    return  is_scalar($value) ? $value : 'think_serialize:' . serialize($value);
}
function unserialize51($value){
    return  0 === strpos($value, 'think_serialize:') ? unserialize(substr($value, 16)) : $value;

}

//生成方法(pc端)
function sitemap(){
    $domain=request()->domain();//首先获取网站域名
    $domain=str_replace('http:', 'https:', $domain);
    $head='<urlset xmlns="http://www.s.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
    $foot=chr(13).'</urlset>';
    $url_head=chr(13)."<url>".chr(13);
    $url_footer=chr(13)."</url>".chr(13);
    $pcmoblie=chr(13).'<mobile:mobile type="pc" xmlns:mobile="http://www.w3.org/2001/XMLSchema-instance"/>';//pc网页定义
    $wapmoblie=chr(13).'<mobile:mobile type="mobile" xmlns:mobile="http://www.w3.org/2001/XMLSchema-instance"/>';//wap网页定义
    $priority=chr(13)."<priority>0.5</priority>"; //定义页面的优先权
    $changefreq=chr(13)."<changefreq>weekly</changefreq>";  //定义页面的更换频率   
  
    $fp=fopen("sitemap.xml",'w');
    fwrite($fp,$head);
    $location1=quiet($domain,$pcmoblie,$wapmoblie,$priority,$changefreq,$url_head,$url_footer);//调用静态数据
    $location2=dynamic($domain,$pcmoblie,$wapmoblie,$priority,$changefreq,$url_head,$url_footer,$location=0);//调用动态数据
    $location=$location1.$location2;//合并数据
    fwrite($fp,$location);
    fwrite($fp,$foot);
    fclose($fp);
}

//定义静态的数据
function quiet($domain,$pcmoblie,$wapmoblie,$priority,$changefreq,$url_head,$url_footer){
    $lastmod=chr(13)."<lastmod>".date('Y-m-d',time()-3*24*3600)."</lastmod>";
    $location=$url_head."<loc>".$domain."</loc>".$pcmoblie.$priority.$lastmod.$changefreq.$url_footer; //pc首页URL
    $location.=$url_head."<loc>".$domain."</loc>".$wapmoblie.$priority.$lastmod.$changefreq.$url_footer; //wap首页URL
    $add=[
        $domain.'/index/case_list.html'
    ];//手动添加项pc端
    $wapadd=[
        $domain.'/index/case_list.html'
    ];//手动添加项wap端
    for($i=0;$i<count($add);$i++){
        $location.=$url_head."<loc>".$add[$i]."</loc>".$pcmoblie.$priority.$lastmod.$changefreq.$url_footer;
        $location.=$url_head."<loc>".$wapadd[$i]."</loc>".$wapmoblie.$priority.$lastmod.$changefreq.$url_footer;
    }
    return $location;
}
//动态数据
function dynamic($domain,$pcmoblie,$wapmoblie,$priority,$changefreq,$url_head,$url_footer,$location){
    $dynamic=Db::name('project')->field('id,update_time')->select(); //(文章详情页)

        foreach ($dynamic as $key => $value) {
            $lastmod=chr(13)."<lastmod>".date('Y-m-d',$value['update_time'])."</lastmod>";
            $url = (string) \think\facade\Route::buildUrl('/index/case_detail/'.$value['id'])->suffix('html')->domain(true);
            $url=str_replace('http:', 'https:', $url);
            // $url =$domain.'/index/case_detail/'.$value['id'].'.html';
            $location.=$url_head."<loc>".$url."</loc>".$pcmoblie.$priority.$lastmod.$changefreq.$url_footer;
            $location.=$url_head."<loc>".$url."</loc>".$wapmoblie.$priority.$lastmod.$changefreq.$url_footer;
        }
    return $location;
}


