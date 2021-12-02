<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>

<?php
//在这个例子中class B和class C有一个同名方法action,class A中在__construct时创建了一个class B并在__destruct时调用了其action方法,我们可以构造目标对象，使得解构函数调用class C的action方法，实现任意代码执行。



class A
{
    var $target;
    function __construct()  // php 魔术函数 构造函数 在创建新对象的时候调用此方法
    {
        $this->target = new B;
    }
    function __destruct()  //php 魔术函数 在对象被销毁的时候调用此方法
    {
        $this->target->action();
    }
}

class B
{
    function action()
    {
        echo "action B";
    }
}

class C
{
    var $test;
    function action()
    {
        echo "action C";
//        eval($this->test);
        show_source(dirname(__FILE__) . '/' . $this->test); //高亮显示目标文件的代码
    }
}

echo "flag in flag.php<br><br><br>";

@unserialize($_GET['test']);   // @去掉警告



?>


