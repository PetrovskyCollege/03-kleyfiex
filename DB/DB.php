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

    public function getPdoConnection(): PDO
    {
        return $this->connection;
    }

    // Если нужно использовать именно метод connect, то можно оставить его, но лучше использовать getPdoConnection
    public function connect(): PDO
    {
        return $this->getPdoConnection();
    }
}
?>