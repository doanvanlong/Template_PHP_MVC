<?php
class Controller
{
    function Model($model)
    {
            require_once './mvc/models/' . $model . '.php';
            return $this->a = new $model;
    }
    function View($view,$data=[])//gán data để gửi dữ liệu cho views
    {
        require_once './mvc/views/' . $view . '.php';
    }
}
?>