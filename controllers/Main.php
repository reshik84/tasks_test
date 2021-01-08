<?php
namespace controllers;

use lib\App;
use lib\Controller;
use models\Task;

class Main extends Controller
{

    public function act_index(){

        $page = isset($_GET['page'])?$_GET['page']:1;
        $order = isset($_GET['order'])?$_GET['order']:'';
	$order_sql = '';
	$order_field = '';
	$order_side = '';

        if($order){
            if($order[0] == '-'){
                $order_side = '';
                $order_field = substr($order, 1);
                $order_sql = $order_field . ' DESC';
            } else {
                $order_side = '-';
                $order_field = $order;
                $order_sql = $order_field . ' ASC';
            }
        }

        $models = Task::findAll($page, $order_sql);
        $flash = isset($_SESSION['success'])?$_SESSION['success']:false;
        unset($_SESSION['success']);
        $this->render('main', [
            'models' => $models,
            'page' => $page,
            'order_field' => $order_field,
            'order_side' => $order_side,
            'order' => $order,
            'flash' => $flash
        ]);
    }

    public function act_create(){
        $data = [];
        if(!empty($_POST)){
            $data = $_POST;
            Task::insert($data);
            if(empty(Task::$errors)) {
                $_SESSION['success'] = 'Задача успешно создана';
                header('Location: /');
                exit();
            }
        }

        $this->render('create', ['errors' => Task::$errors, 'data' => $data]);
    }

    public function act_edit(){
        if(!App::$isAdmin){
            header('Location: /?r=admin');
            exit();
        }
        $model = Task::findOne($_GET['id']);
        if(!$model){
            header('Location: /');
            exit();
        }
        if($_POST){
            if($model->task != $_POST['task']){
                $_POST['in_work'] = 2;
            }
            Task::update($_POST);
            header('Location: /');
            exit();
        }
        $this->render('edit', ['model' => $model]);
    }

    public function imageResize($imageResourceId,$width,$height) {
        $ratio = $width / $height;
        if($ratio > 1){
            $targetWidth = 320;
            $targetHeight = 320/$ratio;
        } else {
            $targetWidth = 240*$ratio;
            $targetHeight = 240;
        }
        $targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
        imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);
        return $targetLayer;
    }

}
