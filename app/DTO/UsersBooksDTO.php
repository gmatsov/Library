<?php


namespace App\DTO;


class UsersBooksDTO
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $user_id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getBookId(): int
    {
        return $this->book_id;
    }

    /**
     * @param int $book_id
     */
    public function setBookId(int $book_id): void
    {
        $this->book_id = $book_id;
    }

    /**
     * @var int
     */
    private $book_id;
}