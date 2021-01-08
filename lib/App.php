<?php

namespace lib;

class App
{

    public static $isAdmin = false;

    public function run(){
        session_start();
        if(isset($_SESSION['admin'])){
            self::$isAdmin = true;
        }
        $route = isset($_GET['r'])?$_GET['r']:'main/index';
        $parts = explode('/', $route);
        $classname = 'controllers\\' . ucfirst($parts[0]);
        try {
            $class = new $classname();
        } catch (\Exception $e){
            echo $e->getMessage(); die();
        }
        $action = 'act_' . (isset($parts[1])?$parts[1]:'index');
        if(!method_exists($class, $action)){
            echo 'Method not found'; die();
        }
        $class->$action();
    }

}