<?php


namespace App\Database;


interface DatabaseInterface
{
    public function query(string $query) : StatementInterface;
}