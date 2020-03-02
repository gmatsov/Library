<?php


namespace App\Models;

use App\Database\PDODatabase;
use App\DTO\BookDTO;

class Books
{
    private const MAX_IMAGE_SIZE = 1024000;
    private const IMAGES_BASE_FOLDER = 'public/images/';
    /**
     * @var PDODatabase
     */
    private $db;

    /**
     * ProductsController constructor.
     * @param $db
     */
    public function __construct(PDODatabase $db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        $stm = $this->db->query('SELECT id, name, isbn FROM books');
        $result = $stm->execute();
        foreach ($result->fetch(BookDTO::class) as $book) {
            yield $book;
        }
    }

    public function getUserBooks()
    {
        $user_id = $_SESSION['user_id'];
        $stm = $this->db->query('SELECT books.id, books.name, books.isbn, books.description FROM books
                                        LEFT JOIN users_books
                                        ON users_books.book_id = books.id
                                        LEFT JOIN users
                                        ON users.id = users_books.user_id
                                        WHERE
                                        users_books.user_id = :user_id');
        $result = $stm->execute(['user_id' => $user_id]);
        foreach ($result->fetch(BookDTO::class) as $book) {
            yield $book;
        }
    }

    public function getBook(int $book_id)
    {
        $stm = $this->db->query('SELECT books.id, books.name, books.isbn, books.description, books.image
                                        FROM books
                                        WHERE books.id = :book_id');

        $book = $stm->execute(['book_id' => $book_id])->getOne(BookDTO::class);

        if (!$book) {
            throw new \Exception('There is no such book');
        }

        return $book;
    }

    public function insert($data)
    {
        /**
         * @var BookDTO $data
         */
        $image_name = time() . $_FILES['book_cover']['name'];
        $image_size = $_FILES['book_cover']['size'];
        $image_file_type = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $valid_file_types = array("jpg", "jpeg", "png", "gif");
        $target_dir = self::IMAGES_BASE_FOLDER;

        if (!in_array($image_file_type, $valid_file_types) || $image_size > self::MAX_IMAGE_SIZE) {
            throw new \Exception('Image is too big or wrong file extension!');
        }
        move_uploaded_file($_FILES['book_cover']['tmp_name'], $target_dir . $image_name);

        $stm = $this->db->query('INSERT INTO books (name, isbn, description, image)
                                        VALUES (:name, :isbn, :description, :image)');
        $book = $stm->execute([
            'name' => $data->getName(),
            'isbn' => $data->getIsbn(),
            'description' => $data->getDescription(),
            'image' => $image_name
        ]);
        return $this->db->lastInsertId();
    }

    public function remove(int $book_id)
    {
        $book = $this->getBook($book_id);
        $image = self::IMAGES_BASE_FOLDER. $book->getImage();

        unlink($image);
        $stm = $this->db->query('DELETE FROM books WHERE  id= :book_id;');
        $result = $stm->execute(['book_id' => $book_id]);
    }

    public function update(BookDTO $book)
    {
        /**
         * @var BookDTO $data
         */
        if (strlen($_FILES['book_cover']['name']) > 0) {
            $image_name = time() . $_FILES['book_cover']['name'];
            $image_size = $_FILES['book_cover']['size'];
            $image_file_type = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
            $valid_file_types = array("jpg", "jpeg", "png", "gif");
            $target_dir = self::IMAGES_BASE_FOLDER;

            if (!in_array($image_file_type, $valid_file_types) || $image_size > self::MAX_IMAGE_SIZE) {
                throw new \Exception('Image is too big or wrong file extension!');
            }
            unlink(self::IMAGES_BASE_FOLDER. $book->getImage());
            move_uploaded_file($_FILES['book_cover']['tmp_name'], $target_dir . $image_name);

            $stm = $this->db->query('UPDATE books 
                                            SET name = :name, isbn = :isbn, description = :description, image = :image
                                            WHERE  id= :book_id');
            $result = $stm->execute([
                'name' => $book->getName(),
                'isbn' => $book->getIsbn(),
                'description' => $book->getDescription(),
                'image' => $image_name,
                'book_id' => $book->getId(),
            ]);

        } else {
            $stm = $this->db->query('UPDATE books 
                                            SET name = :name, isbn = :isbn, description = :description 
                                            WHERE  id= :book_id');
            $result = $stm->execute([
                'name' => $book->getName(),
                'isbn' => $book->getIsbn(),
                'description' => $book->getDescription(),
                'book_id' => $book->getId()
            ]);

        }

        return $book->getId();
    }
}