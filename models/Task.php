<?php


namespace models;


class Task
{
    public $id;
    public $username;
    public $email;
    public $task;
    public $in_work;
    public static $errors = [];

    /**
     * @var $pdo \PDO
     */
    public static $pdo = false;

    public static function init(){
        if(!self::$pdo) {
            self::$pdo = new \PDO(dns, db_user, db_pass);
        }
        self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public static function rowToObj($row){
        $obj = new Task();
        $obj->id = $row['id'];
        $obj->username = $row['username'];
        $obj->email = $row['email'];
        $obj->task = $row['task'];
        $obj->in_work = $row['in_work'];
        return $obj;
    }

    public static function findAll($page = 1, $order = ''){
        self::init();
        $sql = 'SELECT * FROM tasks ';
        if($order){
            $sql .= 'ORDER BY ' . $order;
        }
        $sql .= ' LIMIT ' . (2*($page - 1)) . ',2';
        $sth = self::$pdo->prepare($sql);
        $sth->execute();
        $rows = $sth->fetchAll();
        $res = [];
        foreach ($rows as $row){
            $res[] = Task::rowToObj($row);
        }
        return $res;
    }

    public static function findOne($id){
        self::init();
        $sql = 'SELECT * FROM tasks WHERE id='.(int)$id;
        $sth = self::$pdo->prepare($sql);
        $sth->execute();
        $row = $sth->fetch();
        if($row) {
            return self::rowToObj($row);
        }
    }

    public static function getPageCount(){
        self::init();
        $sql = 'SELECT COUNT(*) as c FROM tasks';
        $sth = self::$pdo->prepare($sql);
        $sth->execute();
        $pages = ceil($sth->fetchColumn(0) / 3);
        return $pages > 1?$pages:0;
    }

    public static function insert($data){
        self::init();
        if(self::validate($data)) {
            $data['task'] = htmlentities($data['task']);
            $sql = 'INSERT INTO tasks (username, email, task) VALUES (:username,:email,:task)';
            $sth = self::$pdo->prepare($sql);
            $sth->execute($data);
        }
        return self::$errors;
    }

    public static function update($data){
        self::init();
        if(self::validate($data, false)) {
            $data['task'] = htmlentities($data['task']);
            $sql = 'UPDATE tasks SET task=:task, in_work=:in_work WHERE id=:id';
            $sth = self::$pdo->prepare($sql);
            $sth->execute($data);
        }
        return self::$errors;
    }

    public static function validate($data, $new = true){
        if($new) {
            if (!isset($data['username']) || (isset($data['username']) && $data['username'] == '')) {
                self::$errors['username'] = 'Неверное имя пользывателя';
            }
            if (!isset($data['email']) || (isset($data['email']) && $data['email'] == '')) {
                self::$errors['email'] = 'Введите e-mail';
            } else {
                $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
                preg_match($pattern, $data['email'], $matches);
                if (empty($matches)) {
                    self::$errors['email'] = 'Неверный e-mail';
                }
            }
        }
        if(!isset($data['task']) || (isset($data['task']) && $data['task'] == '')){
            self::$errors['task'] = 'Введите текст задачи';
        }
        return empty(self::$errors);
    }

    public function getStatus(){
        switch ($this->in_work){
            case 0:
                return 'В обработке';
            case 1:
                return 'Выполнено';
            case 2:
                return 'Отредактировано администратором';
        }
    }

}