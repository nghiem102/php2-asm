<?php
namespace App\Controllers;

use App\Models\Quiz;
use App\Models\Subject;
use App\Models\Question;
use App\Models\StudentQuiz;
use App\Models\StudentQuizDetail;

class QuizController{
    public function index(){
        $subject = Subject::where([
            '0'=>"id",
            '1'=>"=",
            '2'=>$_GET['subject_id']
        ])->first();
        $quizs = Quiz::where([
            '0'=>"subject_id",
            '1' => "=",
            '2' => $_GET['subject_id']
        ])->get();

        include_once "./app/views/admin/quiz/list.php";

    }
    public function addQuiz(){
        $subject = Subject::where(['0'=>'id','1'=>'=','2'=>$_GET['subject_id']])->first();
        include_once "./app/views/admin/quiz/form_add.php";

    }
    public function save_insert_Quiz(){
        
        $model = new Quiz();

        $name = isset($_POST['name']) ? $_POST['name'] : "";
        $subject_id = isset($_POST['subject_id']) ? $_POST['subject_id'] : "";
        $duration = isset($_POST['duration']) ? $_POST['duration'] : "";
        $start_time = isset($_POST['start_time']) ? $_POST['start_time'] : "";
        $end_time = isset($_POST['end_time']) ? $_POST['end_time'] : "";
        $status = isset($_POST['status']) ? $_POST['status'] : "";
        $shuffle = isset($_POST['shuffle']) ? $_POST['shuffle'] : "";
        if ($name=="" || $subject_id==''|| $duration=="" || $start_time==''|| $end_time=="") {
            $msg = "Không được để trống";
             header("Location:".BASE_URL.'mon-hoc/quizs/tao-moi?subject_id='.$subject_id);die;
        }else{
            $data = [
                "name" => $name,
                "subject_id" => $subject_id,
                "duration_minutes" => $duration,
                "start_time" => $start_time,
                "end_time" => $end_time,
                "status" => $status,
                "is_shuffle" => $shuffle,
            ];
            $model->insert($data);
            header("Location:".BASE_URL.'mon-hoc/quizs&subject_id='.$subject_id);die;
            
        }

    }
    public function editQuiz(){
        $quiz = Quiz::where(['0'=>'id','1'=>'=','2'=>$_GET['id']])->first();
        $subject = Subject::where(['0'=>'id','1'=>'=','2'=>$quiz->subject_id])->first();
        
        include_once "./app/views/admin/quiz/form_edit.php";

    }
    public function save_edit_Quiz(){
        $id = isset($_POST['quiz_id']) ? $_POST['quiz_id'] : "";
        $model = Quiz::where(['id', '=', "$id"])->first();
        $name = isset($_POST['name']) ? $_POST['name'] : "";
        $subject_id = isset($_POST['subject_id']) ? $_POST['subject_id'] : "";
        $duration = isset($_POST['duration']) ? $_POST['duration'] : "";
        $start_time = isset($_POST['start_time']) ? $_POST['start_time'] : "";
        $end_time = isset($_POST['end_time']) ? $_POST['end_time'] : "";
        $status = isset($_POST['status']) ? $_POST['status'] : "";
        $shuffle = isset($_POST['shuffle']) ? $_POST['shuffle'] : "";
        if ($name=="" || $subject_id==''|| $duration=="" || $start_time==''|| $end_time=="") {
            $msg = "Không được để trống";
             header("Location:".BASE_URL.'mon-hoc/quizs/cap-nhat?id='.$id );die;
        }else{
            $data = [
                "name" => $name,
                "subject_id" => $subject_id,
                "duration_minutes" => $duration,
                "start_time" => $start_time,
                "end_time" => $end_time,
                "status" => $status,
                "is_shuffle" => $shuffle
               
            ];
            $model-> update($data);
            header("Location:".BASE_URL.'mon-hoc/quizs&subject_id='.$subject_id);die;
            
        }
    }
    public function deleteQuiz(){
        $id = isset($_GET['id'])?$_GET['id']:"";
        $subject_id = isset($_GET['subject_id'])?$_GET['subject_id']:"";
        if ($id == "") {
            
        }else{
            Quiz::destroy($id);
        }
        header('location: ' . BASE_URL . 'mon-hoc/quizs&subject_id='.$subject_id);
            die;
    }


    public function list_quiz(){
        $subject = Subject::where([
            '0'=>"id",
            '1'=>"=",
            '2'=>$_GET['subject_id']
        ])->first();
        $quizs = Quiz::where([
            '0'=>"subject_id",
            '1' => "=",
            '2' => $_GET['subject_id']
        ])->get();

        include_once "./app/views/client/list_quiz.php";
    }
    
    public function result_quiz(){
        $id = $_GET['quiz_id'];
        $quiz = Quiz::where([
            '0'=>"id",
            '1'=>"=",
            '2'=>$_GET['quiz_id']]
            )->first();
        $question = Question::where(['0' => "quiz_id", '1' => "=", '2' => $quiz->id])->get();
        $student_quiz = StudentQuiz::rawQuery("SELECT sq.* , u.name,
        (SELECT COUNT(*) FROM student_quiz_detail sqd WHERE sqd.student_quiz_id = sq.id) as answered
    FROM student_quizs sq JOIN users u ON u.id = sq.student_id
    WHERE sq.quiz_id = $id;")->get();
    foreach($student_quiz as $key => $value){
        $student_quiz_detail = StudentQuizDetail::where(['0'=>"student_quiz_id",'1'=>"=",'2'=>$value->id])->get();
        $question_correct[] = StudentQuizDetail::rawQuery("SELECT count(*) as count_correct FROM student_quiz_detail sqt  JOIN answers an ON sqt.answer_id = an.id WHERE sqt.student_quiz_id = $value->id AND an.is_correct = 1")->first();
    }
    
        include_once "./app/views/admin/quiz/result_quiz.php";
    }
}

?>