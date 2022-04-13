<?php
class Cart extends Controller
{
    function __construct()
    {
        $this->model('CartModel');
    }
    function First()
    {
        $middleware = new LoginMiddleware();
        if ($middleware->XuLy()) {
            //Bảo vệ kiểm tra có session login mới đc vào Home
            //Gọi func Model
            $this->a->ListAll();
            //Gọi View
            $this->View(
                "MasterLayout",
                [
                    "page" => "Cart",
                    "View" => 123
                ]
            );
        } else {
            // echo "vui lòng đăng nhập";
            header('Location:Home');
        }
    }
}
