<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>欢迎来到反序列化靶场</title>
</head>
</html>

<?php

//highlight_file("01.php");

class Object
{
    public $NumberVariable = 1234;
    public $PublicVariable = "bbbb";
    public $Array =array(1,2,3,4,"a","b","c");
}



if(isset($_GET['flag']))
{

    if(@unserialize($_GET['flag'])=='admin')
    {
        echo file_get_contents("flag.php");
        echo "flag 在注释中,使用file_get_contents读取php文件时，结果会储存在网页的注释里面<br>ps:很多ctf比赛吃过这样的亏,题目做出来了，没发现flag,结果在注释里面";
    }
    else
    {
        echo'Oh.no';
    }
}else{
    echo "<h2/>尝试以get方式传入一个flag变量，内容是反序列化后的字符串'admin'";

    echo '<h2/>serialize()   将字符串，数组，或者对象进行序列化';
    echo '<h2/>unserialize()   将序列化的字符串，数组，或者对象进行反序列化';

    echo "<h2/>对于类 Object生成的对象反序列化结果"."<br>";

    echo '<h2/>class Object{'.'<br>'.'public $NumberVariable = 1234;'.'<br>'.'public $PublicVariable = "bbbb";'.'<br>'.'public $Array =array(1,2,3,4,"a","b","c");'.'<br>'.'}';

    $test = new Object();
    echo "<h2/><br>对象反序列化<br>";
    echo  serialize($test)."<br>";
    echo "<h2/><br>数组反序列化<br>";
    echo  serialize($test->Array);
    echo "<h2/><br>字符串反序列化<br>";
    echo  serialize($test->PublicVariable);
    echo "<h2/><br>数字反序列化<br>";
    echo  serialize($test->NumberVariable)."<br>";
}





?>