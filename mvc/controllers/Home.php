<?php
class Home extends Controller
{
    public $SubjectModel;

    function __construct()
    {
        // require_once './mvc/models/SubjectModel.php';
        // GỌi Model
        $this->SubjectModel = $this->Model('SubjectModel');
    }
    // các func là action bổ sung cho Controllers 
    function First()
    {
        //  kết quả trả về từ model gọi hàm ListAll model
        $result = $this->SubjectModel->QueryAll();
        //Gọi View
        $this->View(
            "LayoutAdmin",
            [
                "page" => "Home",
                "ListAll" => $result

            ]
            // gán lại Kết quả trả từ model cho HTML view thông qua tham số truyền vào view 
        );
    }
    function addSubject()
    {
        $result = $this->SubjectModel->insertSubject([
            'email' => '12@gmail.com',
            'firstname' => '123'
        ]);
        //Gọi View
        $this->View(
            "LayoutAdmin",
            [
                "page" => "Home",
                "ListAll" => $result

            ]
            // gán lại Kết quả trả từ model cho HTML view thông qua tham số truyền vào view 
        );
    }
    function updateSubject()
    {
        $result = $this->SubjectModel->updateSubject([
            'email' => '12@gmail.com',
            'firstname' => '123'
        ], 'id', '=', 1);
        //Gọi View
        $this->View(
            "LayoutAdmin",
            [
                "page" => "Home",
                "ListAll" => $result

            ]
            // gán lại Kết quả trả từ model cho HTML view thông qua tham số truyền vào view 
        );
    }
    function deleteSubject()
    {
        $result = $this->SubjectModel->deleteSubject('id', '=', 1);
        //Gọi View
        $this->View(
            "LayoutAdmin",
            [
                "page" => "Home",
                "ListAll" => $result

            ]
            // gán lại Kết quả trả từ model cho HTML view thông qua tham số truyền vào view 
        );
    }
}
