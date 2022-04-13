<?php
class Subject extends Controller
{
    public $SubjectModel;

    function __construct()
    {
        // require_once './mvc/models/SubjectModel.php';
        // GỌi Model
        $this->SubjectModel = $this->Model('SubjectModel');
    }
    // các func là action bổ sung cho Controllers 
    function Add()
    {
        //  kết quả trả về từ model gọi hàm ListAll model
        $result = $this->SubjectModel->QueryAll();
        //Gọi View
        $this->View(
            "LayoutAdmin",
            [
                "page" => "addsubject",
                "ListAll" => $result

            ]
            // gán lại Kết quả trả từ model cho HTML view thông qua tham số truyền vào view 
        );
    }
    function List()
    {
        //  kết quả trả về từ model gọi hàm ListAll model
        $result = $this->SubjectModel->QueryAll('id','desc');
        // Gọi View
        $this->View(
            "LayoutAdmin",
            [
                "page" => "listsubject",
                "result" => $result

            ]
            // gán lại Kết quả trả từ model cho HTML view thông qua tham số truyền vào view 
        );
    }
    function xulyadd(){
        // var_dump($_POST);
        
        $folderUp= dirname(dirname(dirname(__FILE__))).'/public/upload/' ;
        // echo $folderUp;
        move_uploaded_file($_FILES['subject-img']['tmp_name'],$folderUp.$_FILES['subject-img']['name']);
         //  kết quả trả về từ model gọi hàm ListAll model
         $result = $this->SubjectModel->insertSubject([
            'subject_name' => $_POST['subject-name'],
            'subject_img' => $_FILES['subject-img']['name']
        ]);
        echo $result;
        if($result){
           setcookie('msg','Thêm môn học thành công!',time()+10);
        }else{
           setcookie('msg','Thêm môn học thất bại!',time()+10);

        }
        header('Location:../subject/add');
        //Gọi View
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
