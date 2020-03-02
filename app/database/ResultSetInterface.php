<?php


namespace App\Database;


interface ResultSetInterface
{
    public function fetch(string $className);

    public function getOne(string $className);
}