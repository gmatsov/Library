<?php


namespace App;

use App\Core\View;

class Library
{
    public function run()
    {
        session_start();
        spl_autoload_register();

        $url = $_SERVER['REQUEST_URI'];
        $url_data = explode('/', $url);
        array_shift($url_data);
        $app_root = array_shift($url_data);
        define('APP_ROOT', $app_root);

        $controller = $url_data[0] ?? 'books';
        $action_name = $url_data[1] ?? 'index';
        $param = $url_data[2] ?? null;

        $config = parse_ini_file('config/db.ini');
        $pdo = new \PDO($config['dsn'], $config['user'], $config['password']);
        $db = new \App\Database\PDODatabase($pdo);
        $controller_name = ucfirst($controller);
        $controller = 'app\Controllers\\' . $controller_name . 'Controller';
        try {
            if (class_exists($controller) && method_exists($controller, $action_name)) {
                $view = new View($controller_name, $action_name);
                $controller_obj = new $controller($db, $view);

                $controller_obj->$action_name($param);
            } else {
                header('Location: /' . APP_ROOT . '/books/index');
                throw new Exception('Non valid controller!');
            }
        } catch (\Exception $e) {
            header('Location: /' . APP_ROOT . '/' . $controller_name . '/' . $action_name);
            $_SESSION["flash"] = ["type" => "danger", "message" => $e->getMessage()];

        }

    }
}