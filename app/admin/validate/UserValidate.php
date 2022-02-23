<?php
namespace app\admin\validate;
use think\Validate;
class UserValidate extends Validate{
    protected $rule = [
        'username'       => 'require',
        'real_name'      => 'require'
    ];
   
}
?>