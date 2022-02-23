<?php
namespace app\admin\validate;

use think\Validate;

class MemberValidate extends Validate{
    protected $rule = [
        'username'           => 'require',
        'phone'              => 'require|mobile',
        'real_time'          => 'require',
        'id_card'            => 'require|idCard'
    ];
}
?>