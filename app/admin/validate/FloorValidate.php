<?php
namespace app\admin\validate;

use think\Validate;

class FloorValidate extends Validate{
    protected $rule = [
       'floor_num'  => 'require'
    ];
}
?>