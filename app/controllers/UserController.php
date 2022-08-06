<?php

namespace App\Controllers;
use App\Models\BaseModel;
use App\Models\User;

class UserController{
    public function index(){
        $student = User::where(['0'=>'role_id','1'=>"!=","2"=>"1"])->get();
        include_once "./app/views/admin/user/list.php";
    }
    public function form_add(){
        include_once "./app/views/admin/user/form_add.php"; 
    }
    public function save_add(){
        $name = isset($_POST['name']) ? $_POST['name'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $password = isset($_POST['password']) ? $_POST['password'] : "";
        
        // $answer = $_POST["answer"];
        $image = BaseModel::save_file('image', "user/");

        header("location:". BASE_URL."sinh-vien");die;
    }
}

?>