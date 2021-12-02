<?php

$function = @$_GET['f'];

show_source('02.php');  //显示源代码

function filter($v){
    $filter_arr = array('php','flag','php5','php4','fl1g','php5','php6','php7');
    $filter = '/'.implode('|',$filter_arr).'/i';
    return preg_replace($filter,'',$v);   //preg_replace  替换将目标字符串 ，此处是将敏感字符替换为空
}

$_SESSION["user"] = 'guest';
$_SESSION['function'] = $function;

extract($_POST);

if(@!$_GET['img_path']){   // @ 是取消报错
    $_SESSION['img'] = base64_encode('02.php');
}else{
    $_SESSION['img'] = sha1(base64_encode($_GET['img_path'])); // sha1是一种哈希摘要算法 可以类比md5
}

$serialize_info = filter(serialize($_SESSION)); //serialize 序列化

if($function == 'show'){
    $userinfo = unserialize($serialize_info);
    echo file_get_contents(base64_decode($userinfo['img']));  //file_get_contents 读取对应的文件
}