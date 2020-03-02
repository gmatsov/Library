<?php


namespace App\Controllers;

use app\core\View;
use app\database\PDODatabase;

class BaseController
{
    /**
     * @var PDODatabase
     */
    protected $db_connection;

    /**
     * @var View
     */
    protected $view;

    /**
     * ProductsController constructor.
     * @param PDODatabase $db_connection
     * @param View $view
     */
    public function __construct(PDODatabase $db_connection, View $view)
    {
        $this->db_connection = $db_connection;
        $this->view = $view;
        if (!$this->checkSession()) {
            header('Location:/' . APP_ROOT . '/users/login');
            exit;
        }
    }

    public function checkSession()
    {
        if (!$_SESSION['user_id']) {
            return null;
        }
        return true;
    }

    protected function redirect(string $url)
    {
        header('Location:/' . APP_ROOT . $url);
        exit;
    }

    protected function isAdmin()
    {
        if (!$_SESSION['is_admin']) {
            $_SESSION["flash"] = ["type" => "danger", "message" => "Restricted area!"];
            $this->redirect('/books/index');
        }
    }
}