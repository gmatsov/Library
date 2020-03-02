<?php


namespace App\Database;


class PDOPreparedStatement implements StatementInterface
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


    public function execute(array $params = []): ResultSetInterface
    {
        $this->pdoStatement->execute($params);
        return new PDOResultSet($this->pdoStatement);
    }
}