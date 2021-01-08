<?php
namespace controllers;

use lib\App;
use lib\Controller;

class Admin extends Controller
{

    public function act_index(){
        if(App::$isAdmin){
            header('Location: /');
            exit();
        }
        $error = false;
        if(!empty($_POST)){
            if($_POST['login'] == 'admin' && $_POST['password'] == '123'){
                $_SESSION['admin'] = 1;
                header('Location: /');
            } else {
                $error = 'Неверный логин или пароль';
            }
        }
        $this->render('admin', ['error' => $error]);
    }

    public function act_logout(){
        unset($_SESSION['admin']);
        header('Location: /');
    }

}