<?php


namespace App\Controllers;

use app\core\DataBinder;
use App\DTO\UserDTO;
use App\Models\Users;

class UsersController extends BaseController
{

    public function register()
    {
        $user_model = new Users($this->db_connection);

        if ($_POST) {
            $_POST['password'] = $this->validatePassword($_POST['password'], $_POST['confirm_password']);
            $user = DataBinder::bind($_POST, UserDTO::class);
            $user_model->insert($user);

            $_SESSION["flash"] = ["type" => "success", "message" => "Successful created user!"];
            $this->redirect('/');
        } else {
            $this->view->renderView();
        }
    }

    public function login()
    {
        $user_model = new Users($this->db_connection);

        if ($_POST) {

            $user = $user_model->checkUser($_POST);
            if (is_null($user)) {
                $_SESSION["flash"] = ["type" => "danger", "message" => "Wrong credentials or inactive user!"];
                $this->redirect('/users/login');
            }
            $_SESSION['user_id'] = $user->getId();

            if ($user->isIsAdmin()) {
                $_SESSION['is_admin'] = true;
            }
            $this->redirect('/books/index');
        }
        $this->view->renderVIew();
    }

    public function edit()
    {
        $user_model = new Users($this->db_connection);
        $user_id = $_SESSION['user_id'];
        /**
         * @var UserDTO $user
         */
        $user = $user_model->getUserData($user_id);

        if (!empty($_POST)) {
            $this->checkPasswords($user->getPassword(), $_POST['old_password'], $_POST['password'], $_POST['confirm_password']);
            $updated_user = DataBinder::bind($_POST, UserDTO::class);

            $user_model->updateUser($updated_user);

            $_SESSION["flash"] = ["type" => "success", "message" => "Successful updated user!"];
            $this->view->renderView($updated_user);

        } else {
            $this->view->renderView($user);
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);;
        session_destroy();
        $this->redirect('/');
    }

    public function view()
    {
        $this->isAdmin();

        $user_model = new Users($this->db_connection);

        if (!empty($_POST)) {
            $user_id = $_POST['user_id'];
            $is_active = $_POST['is_active'];
            $this->changeUserStatus($user_id, $is_active);
        }
        $this->view->renderView($user_model->getAll());

    }

    public function addToCollection()
    {
        $user_model = new Users($this->db_connection);
        $book_id = $_POST['book_id'];
        $user_id = $_SESSION['user_id'];

        $has_book = $user_model->addToCollection($user_id, $book_id);
        if ($has_book) {
            throw new \Exception('Book already exists in collection');
        } else {
            $_SESSION["flash"] = ["type" => "success", "message" => "Successfully added book to your personal collection!"];
            $this->redirect('/books/index');
        }
    }

    public function removeFromCollection()
    {
        $user_id = $_SESSION['user_id'];
        $book_id = $_POST['book_id'];

        $user_model = new Users($this->db_connection);
        $user_model->removeFromCollection($user_id, $book_id);

        $_SESSION["flash"] = ["type" => "success", "message" => "Successfully removed book to your personal collection!"];
        $this->redirect('/books/my');
    }

    public function checkSession(): bool
    {
        return true;
    }

    private function changeUserStatus(int $user_id, bool $is_active): void
    {
        $user_model = new Users($this->db_connection);

        $user_model->changeStatus($user_id, $is_active);

    }

    private function validatePassword(string $password, string $confirm_password): string
    {
        if ($password != $confirm_password) {
            $_SESSION["flash"] = ["type" => "danger", "message" => "Password mismatch!"];
            $this->redirect('/users/register');
        }
        if (strlen($password) <= 4) {
            $_SESSION["flash"] = ["type" => "danger", "message" => "Password must be at least 5 symbols!"];
            $this->redirect('/users/register');
        }
        return $password;
    }

    private function checkPasswords(string $password_hash, string $old_password, string $password, string $confirm_password)
    {
        if (!password_verify($old_password, $password_hash)) {
            throw new \Exception('Wrong old password');
        }
        if ($password !== $confirm_password) {
            throw new \Exception('New passwords must be the same');
        }
    }
}