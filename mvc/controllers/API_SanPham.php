<?php
class API_SanPham extends Controller{
    public $SanPhamModel;
    function __construct(){
        $this->SanPhamModel=$this->Model("SanPhamModel");
    }
    function First()
    {
        //  kết quả trả về từ model gọi hàm ListAll model
        $result = $this->SanPhamModel->ListAll();
        echo $result;
       
    }
}
?>