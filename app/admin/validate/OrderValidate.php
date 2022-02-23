<?php
namespace app\admin\validate;
use think\Validate;
class OrderValidate extends Validate{
    protected $rule = [
        'real_name'  => 'require',
        'phone'      => 'require|mobile'
 
    ];
}
?>