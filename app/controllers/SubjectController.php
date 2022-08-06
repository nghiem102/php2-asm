<?php
namespace App\Controllers;
use App\Models\Subject;
class SubjectController{

    public function index(){
        
        $subjects = Subject::rawQuery("SELECT 
                        s.*,
                        (SELECT COUNT(*) FROM quizs q WHERE s.id = q.subject_id) as count_quiz
                        FROM `subjects` s")->get();
        include_once "./app/views/admin/subject/list.php";

    }
    public function formAdd(){
        
        include_once "./app/views/admin/subject/form_add.php";

    }
    public function saveAdd(){
        $model = new Subject();
        $name = isset($_POST['name']) ? $_POST['name'] : "";
        $author_id = isset($_POST['author_id']) ? $_POST['author_id'] : "";
        if ($name=="" || $author_id=='') {
            $msg = "Không được để trống";
             header("Location:".BASE_URL.'mon-hoc/tao-moi');die;
        }else{
            $data = [
                "name" => $name,
                "author_id" => $author_id
            ];
            $model->insert($data);
            header("Location:".BASE_URL.'mon-hoc');die;
            
        }
    }
    public function formEdit(){
        if (empty($_GET['id'])) {
            header("Location:".BASE_URL.'mon-hoc');die;
        }else{
            $data = [
                "0" => 'id',
                "1" => "=",
                "2" => $_GET['id']
            ];
            $subject = Subject::where($data)->first();
            include_once "./app/views/admin/subject/form_edit.php";
        }
    }
    public function saveEdit(){
        $id = $_POST['id'];
        $model = Subject::where(['id', '=', "$id"])->first();
        if(!$model){
            header('location: ' . BASE_URL . 'mon-hoc');
            die;
        }
        if ($_POST['name']=="") {
            $data = [
                "0" => 'id',
                "1" => "=",
                "2" => $id
            ];
            $subject = Subject::where($data)->first();
            $view = "./app/views/subject/form_edit.php";
            include_once "./app/views/author/index.php";
        }else{
            $data = [
                'name' => $_POST['name']
            ];
            $model->update($data);
            header('location: ' . BASE_URL . 'mon-hoc');
            die;
        }
        
    }
    public function delete(){
        $id = isset($_GET['id'])?$_GET['id']:"";
        if ($id == "") {
            
        }else{
            Subject::destroy($id);
        }
        header('location: ' . BASE_URL . 'mon-hoc');
            die;
    }

}
