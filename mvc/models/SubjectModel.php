<?php
class SubjectModel extends DB
{
    // public $table = "subject";

    function __construct()
    {
        parent::__construct();//khởi chạy hàm contruct DB
    }
    function QueryAll($orderBy,$value)
    {
    //    $kq= $this->QueryAll();//gọi hàm query all bên DB
    //    return json_encode($kq);
    $kq=$this->table('subject')->orderBy($orderBy,$value)->get();
          return ($kq);
// 
    }
    function QueryOne($colum,$operator,$value)
    {
    //    $kq= $this->QueryAll();//gọi hàm query all bên DB
    //    return json_encode($kq);
    $kq=$this->table('subject')->where($colum,$operator,$value)->get();
          return json_encode($kq);
// 
    }
    function insertSubject($args){
        $kq = $this->table('subject')->insert($args);
        return json_encode($kq);
    }
    function updateSubject($args,$colum, $operator, $value){
        $kq = $this->table('subject')->update($args,$colum, $operator, $value);
        return json_encode($kq);
    }
    function deleteSubject($colum, $operator, $value){
        $kq = $this->table('subject')->delete($colum,$operator,$value);
        return json_encode($kq);
    }
   
   
    
}
