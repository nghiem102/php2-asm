<?php

namespace App\Controllers;

use App\Models\Quiz;
use App\Models\Subject;
use App\Models\Question;
use App\Models\Answer;
use App\Models\BaseModel;
use App\Models\StudentQuiz;
use App\Models\StudentQuizDetail;
use DateTime;

use function PHPSTORM_META\type;

date_default_timezone_set('Asia/Ho_Chi_Minh');

class QuestionController
{

    public function index()
    {
        $quiz = Quiz::where(['0' => 'id', '1' => '=', '2' => $_GET['quiz_id']])->first();
        $subject = Subject::where(['0' => 'id', '1' => '=', '2' => $quiz->subject_id])->first();

        $question = Question::where(['0' => 'quiz_id', '1' => '=', '2' => $_GET['quiz_id']])->get();
        $answer = Answer::all();
        include_once "./app/views/admin/question/list.php";
    }

    public function addQuestion()
    {
        $quiz = Quiz::where(['0' => 'id', '1' => '=', '2' => $_GET['quiz_id']])->first();
        $subject = Subject::where(['0' => 'id', '1' => '=', '2' => $quiz->subject_id])->first();
        include_once "./app/views/admin/question/form_add.php";
    }
    public function saveQuestion()
    {
        $question = isset($_POST['question']) ? $_POST['question'] : "";
        $quiz_id = isset($_POST['quiz_id']) ? $_POST['quiz_id'] : "";
        $answer = $_POST["answer"];
        $image_question = QuestionController::save_file('image_question', "question/");

        $is_correct = isset($_POST['is_correct']) ? $_POST['is_correct'] : null;
        $data = [
            "name" => $question,
            "quiz_id" => $quiz_id,
            "img" => $image_question
        ];
        $boot_question = new Question;
        $id_question = $boot_question->insert_and_lastid($data);
        if ($id_question->id > 0) {
            $boot_answer = new Answer;
            for ($i = 0; $i < count($answer); $i++) {
                if ($is_correct != null && in_array($i, $is_correct)) {
                    $is_flag = true;
                } else {
                    $is_flag = false;
                }
                $boot_answer->insert([
                    "content" => $answer[$i],
                    "question_id" => $id_question->id,
                    "is_correct" => $is_flag,
                ]);
            }
        };
        header("location:" . BASE_URL . 'mon-hoc/cau-hoi&quiz_id=' . $quiz_id);
    }

    public function deleteQuestion()
    {
        $question_id = isset($_GET['question_id']) ? $_GET['question_id'] : "";
        $quiz_id = isset($_GET['quiz_id']) ? $_GET['quiz_id'] : "";
        $answer_id = Answer::where(['0' => 'question_id', '1' => '=', '2' => $question_id])->get();
        for ($i = 0; $i < count($answer_id); $i++) {
            Answer::destroy($answer_id[$i]->id);
        }
        Question::destroy($question_id);
        header("location:" . BASE_URL . 'mon-hoc/cau-hoi&quiz_id=' . $quiz_id);
    }

    public function save_file($fieldname, $target_dir)
    {
        $file_upload = $_FILES[$fieldname];
        $file_name = basename($file_upload['name']);
        $targer_path = IMAGE_DIR . $target_dir . $file_name;
        move_uploaded_file($file_upload['tmp_name'], $targer_path);
        return $file_name;
    }

    // Lưu nhiều file upload
    public function multiple_save_image($fieldname, $target_dir)
    {
        $file_upload = $_FILES[$fieldname];
        $count = count($file_upload['name']);
        for ($i = 0; $i < $count; $i++) {
            $file_name = basename($file_upload['name'][$i]);
            $targer_path = $target_dir . $file_name;
            move_uploaded_file($file_upload['tmp_name'][$i], $targer_path);
        }
        //Chưa basename
        return $file_upload['name'];
    }


    ///client


    public function exam_quiz()
    {
        $student = StudentQuiz::where(['0'=>"student_id",'1'=>"=",'2'=>$_SESSION['user']['id']])->andWhere(['0'=>"quiz_id",'1'=>"=",'2'=>$_GET['quiz_id']])->first();
       
        if ($student!=null) {
            header("location:".BASE_URL."result-exam?quiz_id=".$_GET['quiz_id']);die;
        }
        $quiz = Quiz::where(['0' => 'id', '1' => '=', '2' => $_GET['quiz_id']])->first();
        $question = Question::where(['0' => "quiz_id", '1' => "=", '2' => $quiz->id])->get();
        $answer = Answer::all();
        $start_time = date("Y-m-d H:i:s");
        include_once "./app/views/client/form_exam.php";
    }
    public function submit_exam_quiz()
    {
        $total_question = $_POST["total_question"];
        $point = 0;
        foreach ($_POST['answer'] as $key => $value) {
            $check = Answer::where(['0' => "id", '1' => "=", '2' => $value])->first();
            if ($check->is_correct == 1) {
                $point += 1;
            }
        }
        $score = number_format(($point / $total_question) * 10,2,'.',',');

        $start_time = $_POST['start_time'];
        $end_time = date("Y-m-d H:i:s");
        $data = [
            "student_id" => $_SESSION['user']['id'],
            "quiz_id" => $_POST['quiz_id'],
            "start_time" => $start_time,
            "end_time" => $end_time,
            "score" => $score
        ];
        $model = new StudentQuiz;
        $student_quiz_id = $model->insert_and_lastid($data);
        $model_2 = new StudentQuizDetail;
        foreach ($_POST['answer'] as $key => $value) {
            $data2 =[
                "student_quiz_id" => ($student_quiz_id->id),
                "answer_id"=> $value
            ];
            $model_2->insert($data2);
        }
        header("location:".BASE_URL."result-exam?quiz_id=".$_POST['quiz_id']);die;
    }
    public function result_exam(){
        $quiz = Quiz::where([
            '0'=>"id",
            '1'=>"=",
            '2'=>$_GET['quiz_id']]
            )->first();
        $question = Question::where(['0' => "quiz_id", '1' => "=", '2' => $quiz->id])->get();
        $student_quiz = StudentQuiz::where(['0'=>"quiz_id",'1'=>"=",'2'=>$quiz->id])->andWhere(['0'=>"student_id",'1'=>"=",'2'=>$_SESSION['user']['id']])->first();
        $student_quiz_detail = StudentQuizDetail::where(['0'=>"student_quiz_id",'1'=>"=",'2'=>$student_quiz->id])->get();
        $question_correct = StudentQuizDetail::rawQuery("SELECT count(*) as count_correct FROM student_quiz_detail sqt  JOIN answers an ON sqt.answer_id = an.id WHERE sqt.student_quiz_id = $student_quiz->id AND an.is_correct = 1")->first();
        include_once "./app/views/client/result_exam.php";
    }
    
}
