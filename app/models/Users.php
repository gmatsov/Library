<?php


namespace App\Models;

use App\Database\PDODatabase;
use App\DTO\UserDTO;
use App\DTO\UsersBooksDTO;

class Users
{
    /**
     * @var PDODatabase
     */
    private $db_connection;

    /**
     * Users constructor.
     * @param $db_connection
     */
    public function __construct(PDODatabase $db_connection)
    {
        $this->db_connection = $db_connection;
    }

    public function insert($data): int
    {
        /**
         * @var UserDTO $data
         */

        $stm = $this->db_connection->query('SELECT email FROM users
                                        WHERE email = :email');
        $has_email = $stm->execute(['email' => $data->getEmail()]);
        $has_email = $has_email->getOne(UserDTO::class);

        if ($has_email) {
            throw new \Exception('User already exists on database');
        }

        $stm = $this->db_connection->query('INSERT INTO users (first_name, last_name, email, password) 
                                                    VALUES (:first_name, :last_name, :email, :password)');
        $result = $stm->execute([
            'first_name' => $data->getFirstName(),
            'last_name' => $data->getLastName(),
            'email' => $data->getEmail(),
            'password' => $data->getPassword()
        ]);

        return $this->db_connection->lastInsertId();
    }

    public function checkUser($data): ?UserDTO
    {
        $email = $data['email'];
        $password = $data['password'];
        $stm = $this->db_connection->query('SELECT id, password, is_active, is_admin
                                                    FROM users 
                                                    WHERE email = :email');
        /**
         * @var UserDTO $result
         */
        $result = $stm->execute(['email' => $email])->getOne(UserDTO::class);

        if ($result) {
            if (password_verify($password, $result->getPassword()) && $result->isIsActive()) {
                return $result;
            }
        }
        return null;
    }

    public function getAll(): \Generator
    {
        $stm = $this->db_connection->query('SELECT id, first_name, last_name, email, is_active 
                                                    FROM users 
                                                    WHERE is_admin = false');
        $users = $stm->execute();
        foreach ($users->fetch(UserDTO::class) as $user) {
            yield $user;
        }
    }

    public function changeStatus(int $user_id, bool $is_active): void
    {
        $stm = $this->db_connection->query('UPDATE users 
                                                    SET is_active = :is_active 
                                                    WHERE  id = :user_id');
        $result = $stm->execute([
            'is_active' => !$is_active,
            'user_id' => $user_id
        ]);
    }

    public function getUserData(int $user_id): UserDTO
    {
        $stm = $this->db_connection->query('SELECT id, first_name, last_name, email, password
                                                    FROM users
                                                    WHERE id = :user_id');
        $user = $stm->execute(['user_id' => $user_id])->getOne(UserDTO::class);

        return $user;
    }

    public function updateUser($user_data): void
    {
        /**
         * @var UserDTO $user_data
         */
        $user_id = $_SESSION['user_id'];

        $stm = $this->db_connection->query('UPDATE users
                                                    SET first_name = :first_name, last_name = :last_name, email = :email, password = :password
                                                    WHERE  id = :user_id;');
        $user = $stm->execute([
            'user_id' => $user_id,
            'first_name' => $user_data->getFirstName(),
            'last_name' => $user_data->getLastName(),
            'email' => $user_data->getEmail(),
            'password' => $user_data->getPassword()
        ]);
    }

    public function addToCollection(int $user_id, ?int $book_id)
    {
        $stm = $this->db_connection->query('SELECT user_id, book_id FROM users_books
                                                WHERE user_id = :user_id
                                                AND book_id = :book_id');
        $result = $stm->execute([
                'user_id' => $user_id,
                'book_id' => $book_id
            ]);

        $has_record = $result->getOne(UsersBooksDTO::class);
        if ($has_record) {
            throw new \Exception('Book already exists in collection');
        } else {
            $stm = $this->db_connection->query('INSERT INTO users_books (user_id, book_id) 
                                                        VALUES (:user_id, :book_id)');
            $result = $stm->execute([
                'user_id' => $user_id,
                'book_id' => $book_id
            ]);
        }
        return false;
    }

    public function removeFromCollection(int $user_id, int $book_id): void
    {
        $stm = $this->db_connection->query('DELETE FROM users_books 
                                                    WHERE user_id = :user_id
                                                    AND book_id = :book_id');
        $result = $stm->execute([
            'user_id' => $user_id,
            'book_id' => $book_id
        ]);
    }
}