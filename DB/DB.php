<?php

class DB
{
    public PDO $connection;

    public function __construct(string $dbName, string $host = "localhost", string $user = "root", string $pass = "")
    {
        try {
            $this->connection = new PDO('mysql:host=' . $host . ';dbname=' . $dbName . '', $user, $pass);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function connect(){
        return  $this->connection;
    }

}