<?php
class App
{
    private $controller = "Home";
    private $action = "First";
    private $params = [];
    public $config=[];
    // http://localhost/ExOOP/Home/First/123
    function __construct()
    {
        $this->config =[
            'rootPath'=>dirname(dirname(dirname(__FILE__))),
        ];
        //khai báo thuộc tính ,biến url và gán =.  gọi đến func XulyUrl
        $this->url = $this->XuLyUrl();
        if($this->url ==''){
           header('Location:home/first');
        }
        // xử lý Controllers
        //Hàm kiểm tra Có tồn tại Url ko  + File có tồn tại ko
        if ($this->url) {
            if (file_exists('./mvc/controllers/' . $this->url[0] . '.php')) {
                $this->controller = $this->url[0];
            }
            //tránh trường hợp nhập sai controller
            // Xử lý Controllers xong thì huỷ controller trong mảng url đi
            unset($this->url[0]);
        }
        //mặc định là controllers Home nếu nhập sai Or ko Nhập Url
        require_once './mvc/controllers/' . $this->controller . '.php';


        //xử lý Actions (Func)
        // Mặc định là Func First  
        if (isset($this->url[1])) {
            //hàm kiểm tra Func có tồn tại trong Class  ko
            if (method_exists($this->controller, $this->url[1])) { //Dòng 23 đã requice Controller class Home rồi
                $this->action = $this->url[1];
            }
            // Huỷ action khi đã xử lý xong 
            unset($this->url[1]);
        }

        //xử lý Params
        // Sau khi unset controller + action còn lại là params
        $this->params = $this->url ? array_values($this->url) : [];
        // Kiểm tra if  url : có tồn tại thì lấy giá trị cho mảng url đó . ngc lại params là mảng rỗng

        //Ko thể làm như v :  new Class (Home...)
        //  $model=new $this->controller;
        //  $model->$this->action."()";
        //tương ứng với gọi hàm 
        // First();
        call_user_func_array([new $this->controller, $this->action],$this->params);
    }
    function XuLyUrl()
    {
        //xử lý url 
        if (isset($_GET["url"])) {

            //filter_var + trim : đảm bảo sạch : loại bỏ khoảng trắng trước khi cắt url
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
    }
}
