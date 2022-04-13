<?php 
    class LoginMiddleware extends Middlewares{
        // phải theo luật của Middlewares ( Func XuLy)
            function XuLy()
            {
                if(isset($_SESSION["login"])){
                    return true;
                }else{
                    return false;
                }
            }
    }
?>