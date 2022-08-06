<?php

namespace App\Controllers;
use App\Models\User;
use App\Models\Subject;
use App\Models\Quiz;
use App\Models\Question;

class DashboardController
{

    public function __construct()
    {
    }

    public function index()
    {
        include_once  './app/views/home.php';

    }
    public function admin_dashboard(){
        $subject = Subject::all();
        $quiz = Quiz::all();
        $user = User::where(["0"=>'role_id',"1"=>'!=',"2"=> 1])->get();
        $quenstion = Question::all();
        require_once './app/views/admin/dashboard.php';
    }
    public function client_dashboard(){
        $subject = Subject::rawQuery("SELECT 
        s.*,
        (SELECT COUNT(*) FROM quizs q WHERE s.id = q.subject_id) as count_quiz
        FROM `subjects` s")->get();
        include_once './app/views/client/index.php';
    }
    
}
