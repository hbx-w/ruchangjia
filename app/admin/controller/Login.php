<?php
namespace app\admin\controller;

use think\exception\ValidateException;
use think\facade\Db;

class Login extends Base{
    public function doLogin()
    {
        if(request()->isPost()){
            $username = input('post.username');
            $password = input('post.password');
            $code = input('post.code');
            try{
                validate('LoginValidate',compact('username','password'));
            }catch(ValidateException $e){
                return json(['code'=>0,'msg'=>$e->getError()]);
            }
            $hasone = Db::name('admin')->where(['username'=>$username])->find();
            if(empty($hasone)){
                return json(['code'=>0,'msg'=>'用户名不存在']);
            }
            $password = md5(md5($password));
            if($hasone['password'!= $password]){
                return json(['code'=>0,'msg'=>'用户名或密码错误']);
            }
            return json(['code'=>1,'data'=>url('index/index'),'msg'=>'登录成功']);
        }
    }
    public function Loginout()
    {
        session(null);
        return json(['code'=>1,'data'=>[],'msg'=>'退出成功']);
    }
}
?>