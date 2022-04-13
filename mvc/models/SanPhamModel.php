<?php
class SanPhamModel extends DB
{
    public $table = "san_pham";

    function __construct()
    {
        parent::__construct();//khởi chạy hàm contruct DB
    }
    function ListAll()
    {
       $kq= $this->QueryAll();//gọi hàm query all bên DB
       return json_encode($kq);
    }
  
   
    
}
?>