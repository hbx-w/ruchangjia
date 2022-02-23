<?php
namespace app\admin\controller;

use think\facade\Filesystem;

class Upload extends Base{
    public function upload()
    {
        $file = request()->file('image');
        $savename = Filesystem::putFile('topic',$file);
        return json(['code=>1','path'=>$savename]);

    }
}
?>