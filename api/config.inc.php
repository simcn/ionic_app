<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");

date_default_timezone_set("Asia/Shanghai");

$dbConfig = array(
    'dsn'=>'mysql:host=127.0.0.1;dbname=agro365',
    'user'=>'root',
    'pass'=>''
);

//指定页面编码
//header('Content-Type: text/html; charset='.PAGE_CODE);

require './lib/class.safeinput.php';//输入过滤类
require './lib/db.class.php';//数组转SQL类
require './model/h5.php';

?>
