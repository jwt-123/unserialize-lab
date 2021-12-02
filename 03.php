<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
</html>

<?php
//使用CVE-2016-7124绕过 当序列化字符串中表示对象属性个数的值大于真实的属性个数时会跳过__wakeup的执行
class Demo
{
    protected $file = 'index.php';

    function __destruct()   //__destruct php魔术函数 当对象被销毁的时候被调用
    {
        if (!empty($this->file)) {   // empty 判断文件是否为空
            if (strchr($this->file, "\\") === false && strchr($this->file, '/') === false) //strchr 函数搜索字符串在另一字符串中的第一次出现，返回字符串的另外一部分
                show_source(dirname(__FILE__) . '/' . $this->file); //高亮显示目标文件的代码
            else
                die('Wrong filename.');     //终止程序，并输出括号里面的字符串
        }
    }

    function __wakeup()   //__wakeup php魔术函数  使用unserialize()反序列化时会自动调用
    {
        $this->file = 'index.php';
    }
}

if (!isset($_GET['file'])) {
    show_source(__FILE__);
} else {
    $a = $_GET['file'];
    @unserialize($a);
}








?>





