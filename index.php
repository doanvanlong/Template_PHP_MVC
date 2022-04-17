<?php
session_start();
require_once './mvc/Bridge.php';
//Gọi Bridge.php trong Bridge gọi App.php
// Đứng từ đây có thể dùng những gì có trong App.php
$myApp = new App();
// Tạo mới đối tượng chạy hàm Contructor
$config=$myApp->config;
?>