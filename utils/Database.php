<?php

const MYSQL_HOST = 'localhost';
const MYSQL_USER = 'root';
const MYSQL_PASSWORD = '';
const MYSQL_DB_NAME = 'empresinha';

global $pdo;
$pdo = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD);

class Database
{

    public static function connection(): PDO
    {
        global $pdo;
        return $pdo;
    }

}