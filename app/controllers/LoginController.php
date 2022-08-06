<?php
namespace App\Controllers;
use App\Models\User;
class LoginController{

    public function index(){
            include_once  './app/views/login/index.php';
    }
    public function login(){
        if ($_POST['email'] == "" || $_POST['password'] == "") {
            header('location:'.BASE_URL.'login');
            die;
        }else{
            $data = [
                '0'=> 'email',
                '1'=>'=',
                '2'=>$_POST['email']
            ];
           
            $password = $_POST['password'];
            $user = User::where($data)->first();
          
            if ($user != null) {
                if (password_verify($password,$user->password)) {
                    $_SESSION['user']['id'] = $user->id;
                    $_SESSION['user']['name'] = $user->name;
                    $_SESSION['user']['email'] = $user->email;
                    $_SESSION['user']['avartar'] = $user->avatar;
                    $_SESSION['user']['role_id'] = $user->role_id;
                    if ($_SESSION['user']['role_id']==1) {
                        header('location:'.BASE_URL.'dashboard');
                        die;
                    }else{
                        header('location:'.BASE_URL.'homepage');
                        die;
                    }
                    
                }
                else{
                    header('location:'.BASE_URL.'user-login');
                    die;
                }
            }
        }
    }
   



    public function logout(){
        session_destroy();
        header('location:'.BASE_URL.'user-login');
                    die;
    }

}

?>