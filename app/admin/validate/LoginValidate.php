<?php
namespace app\admin\validate;

use think\Validate;

class LoginValidate extends Validate{
    protected $rule = [
        'username'      => 'require|unique:admin',
        'password'      => 'require|min:8|max:18',
        'code'          => 'require|captcha'
    ];
}
?>