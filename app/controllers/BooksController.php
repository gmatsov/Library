<?php


namespace App\Controllers;

use app\core\DataBinder;
use App\DTO\BookDTO;
use App\Models\Books;


class BooksController extends BaseController

{
    const IMAGE_BASE_PATH = 'images/';

    public function index()
    {
        $book = new Books($this->db_connection);
        $data = $book->getAll();
        $this->view->renderView($data);
    }

    public function add()
    {
        $this->isAdmin();

        $book_model = new Books($this->db_connection);
        if (!empty($_POST)) {
            $book = DataBinder::bind($_POST, BookDTO::class);
            $data = $book_model->insert($book);
            $this->redirect('/books/view/' . $data);
        } else {
            $this->view->renderView();
        }
    }

    public function remove(int $book_id)
    {
        $this->isAdmin();

        $book = new Books($this->db_connection);
        $book->remove($book_id);

        $this->redirect('/books/index');
    }

    public function edit(int $id = null)
    {
        $this->isAdmin();
        /**
         * @var BookDTO $book
         */
        if ($id == null || is_string($id)) {
            $_SESSION["flash"] = ["type" => "danger", "message" => "No such book"];
            $this->redirect('/books/index');
        }
        $book_model = new Books($this->db_connection);
        $book = $book_model->getBook($id);


        $book->setImageSrc(self::IMAGE_BASE_PATH . $book->getImage());
        $book_cover = $book->getImage();

        if ($_POST) {
            $book = DataBinder::bind($_POST, BookDTO::class);
            $book->setImage($book_cover);

            $id = $book_model->update($book);
            $this->redirect('/books/edit/' . $id . '');
        }

        $this->view->renderView($book);
    }

    public function my()
    {
        $book_model = new Books($this->db_connection);

        $books = $book_model->getUserBooks();

        $this->view->renderView($books);
    }

    public function view($book_id)
    {
        if (intval($book_id) == 0) {
            $this->redirect('/books/index');
        } else {
            $book_model = new Books($this->db_connection);

            $book = $book_model->getBook($book_id);
                  /**
             * @var BookDTO $book
             */
            $book->setImageSrc(self::IMAGE_BASE_PATH . $book->getImage());

            $this->view->renderView($book);
        }
    }
}