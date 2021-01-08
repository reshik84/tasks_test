<?php


namespace lib;


class Controller
{

    public function render($view, $params = [], $layout = true){
        $filename = __DIR__ . '/../views/' . $view . '.php';
        extract($params);
        if($layout) {
            ob_start();
            include $filename;
            $content = ob_get_clean();
            include __DIR__ . '/../views/_layout.php';
        } else {
            include $filename;
        }
    }

}