<?php
session_start();
require("./05.php");

$f3 = new foo3();
$f3->varr = "phpinfo();";
$f3->execute();
?>