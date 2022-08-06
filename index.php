<?php
require_once './vendor/autoload.php';
require_once './commons/helpers.php';
$url = isset($_GET['url']) ? $_GET['url'] : "/";

use App\Controllers\LoginController;
use App\Controllers\DashboardController;
use App\Controllers\SubjectController;
use App\Controllers\QuizController;
use App\Controllers\QuestionController;
use App\Controllers\UserController;
use App\Models\Quiz;

switch ($url) {
    case '/':
        // var_dump(password_hash('123456',PASSWORD_DEFAULT));
        // die;
        $ctr = new DashboardController();
        $ctr->index();
        break;
    case 'user-login':
        $ctr = new LoginController();
        $ctr->index();
        break;
    case 'admin-login':
        $ctr = new LoginController();
        $ctr->index();
        break;
    case 'submit-login':
        $ctr = new LoginController();
        $ctr->login();
        break;
    case 'logout':
        $ctr = new LoginController();
        $ctr->logout();
        break;
    case 'dashboard':
        $ctr = new DashboardController();
        $ctr->admin_dashboard();
        break;
    
    case 'mon-hoc':
        $ctr = new SubjectController();
        $ctr->index();
        break;
    case 'mon-hoc/tao-moi':
        $ctr = new SubjectController();
        $ctr->formAdd();
        break;
    case 'mon-hoc/luu-tao-moi':
        $ctr = new SubjectController();
        $ctr->saveAdd();
        break;
    case 'mon-hoc/xoa':
        $ctr = new SubjectController();
        $ctr->delete();
        break;
    case 'mon-hoc/chi-tiet':
        break;
    case 'mon-hoc/cap-nhat':
        $ctr = new SubjectController();
        $ctr->formEdit();
        break;
    case 'mon-hoc/luu-cap-nhat':
        $ctr = new SubjectController();
        $ctr->saveEdit();
        break;
    case 'mon-hoc/quizs':
        $ctr = new QuizController();
        $ctr->index();
        break;
    case 'mon-hoc/chi-tiet-quizs':
        break;
    case 'mon-hoc/quizs/tao-moi':
        $ctr = new QuizController();
        $ctr->addQuiz();
        break;
    case 'mon-hoc/quizs/luu-tao-moi':
        $ctr = new QuizController();
        $ctr->save_insert_Quiz();
        break;
    case 'mon-hoc/quizs/cap-nhat':
        $ctr = new QuizController();
        $ctr->editQuiz();
        break;
    case 'mon-hoc/quizs/luu-cap-nhat':
        $ctr = new QuizController();
        $ctr->save_edit_Quiz();
        break;
    case 'mon-hoc/quizs/xoa':
        $ctr = new QuizController();
        $ctr->deleteQuiz();
        break;
    case 'mon-hoc/cau-hoi':
        $ctr = new QuestionController();
        $ctr->index();
        break;
    case 'mon-hoc/cau-hoi/them-moi':
        $ctr = new QuestionController();
        $ctr->addQuestion();
        break;
    case 'mon-hoc/cau-hoi/luu-them-moi':
        $ctr = new QuestionController();
        $ctr->saveQuestion();
        break;
    case 'mon-hoc/cau-hoi/xoa':
        $ctr = new QuestionController();
        $ctr->deleteQuestion();
        break;
    case 'sinh-vien':
        $ctr = new UserController();
        $ctr->index();
        break;
    case 'sinh-vien/them-moi':
        $ctr = new UserController();
        $ctr->form_add();
        break;
    case 'sinh-vien/luu-tao-moi':
        $ctr = new UserController();
        $ctr->save_add();
        break;
    case 'chi-tiet-diem':
        $ctr = new QuizController();
        $ctr->result_quiz();
        break;
    ///client
    case 'homepage':
        $ctr = new DashboardController();
        $ctr->client_dashboard();
        break;
    case 'client-quiz':
        $ctr = new QuizController();
        $ctr->list_quiz();
        break;
    case 'client-exam-quiz':
        $ctr = new QuestionController();
        $ctr->exam_quiz();
        break;
    case 'client-submit-exam':
        $ctr = new QuestionController();
        $ctr->submit_exam_quiz();
        break;
    case 'result-exam':
        $ctr = new QuestionController();
        $ctr->result_exam();
        break;
    default:
        echo "<h2>Trang này không tồn tại</h2>";
        break;
}
