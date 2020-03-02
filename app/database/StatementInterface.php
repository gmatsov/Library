<?php


namespace App\Database;


interface  StatementInterface
{
    public function execute(array $params = []): ResultSetInterface;
}