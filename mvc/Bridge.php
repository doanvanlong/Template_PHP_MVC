<?php
    // Tạo Bridge.php làm cầu nối giữa Index.php và các mục trong MVC ,
    // <=> Bridge cùng cấp với MVC dể require_once
    require_once 'core/App.php';
    require_once 'core/Controller.php';
    require_once 'core/Autoload.php';
    require_once 'core/DB.php';
?>