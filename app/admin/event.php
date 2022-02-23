<?php
// 这是系统自动生成的admin应用event定义文件
return [
    'bind'    =>    [
      //  'UserLogin' => 'app\event\UserLogin',
        // 更多事件绑定
    ],
	'listen'  =>    [
        'MemberGroupChange' => ['app\admin\listener\UserPayOk'],
        'MemberReferidReg' => ['app\admin\listener\MemberReferidReg'],
        // 更多事件监听
        //商户审核通过加默认组件
        'MerchantDefaultWidget' => ['app\admin\listener\MerchantDefaultWidget'],
        //商户审核通过添加商家二维码
        'MerchantQrcode' => ['app\admin\listener\MerchantQrcode'],
        //商户审核通过默认加当下免费的应用
        'MerchantDefaultApply' => ['app\admin\listener\MerchantDefaultApply'],
    ],
];
