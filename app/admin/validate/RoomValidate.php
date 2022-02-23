<?php
namespace app\admin\validate;
use think\Validate;
class RoomValidate extends Validate{
    protected $rule = [
        'type'       => 'require'
    ];
    protected $message = [
        '房间类型'   => '不能为空'
    ];
}
?>