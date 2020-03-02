<?php


namespace App\Database;


class PDOResultSet implements ResultSetInterface
{
    /**
     * @var \PDOStatement
     */
    private $pdoStatement;

    /**
     * PDOResultSet constructor.
     * @param $PDOStatement
     */
    public function __construct(\PDOStatement $PDOStatement)
    {
        $this->pdoStatement = $PDOStatement;
    }


    public function fetch(string $className)
    {
        while ($row = $this->pdoStatement->fetchObject($className)) {
            yield $row;
        };
    }

    public function getOne(string $className)
    {
        return $this->pdoStatement->fetchObject($className);
    }


}