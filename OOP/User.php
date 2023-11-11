<?php

class User {
    public $db;

    // Конструктор класса User
    public function __construct(DB $db) {
        $this->db = $db;
    }

    // Метод для входа
    public function login($username, $password) {
        $sql = "SELECT * FROM user WHERE nickname = :username AND password = :password";
        $stmt = $this->db->connection->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            return true;
        } else {
            return false;
        }
    }

    public function register($nickname, $first_name, $last_name, $email, $password) {
        $sql = "INSERT INTO user (nickname, first_name, last_name, email, password) 
                VALUES (:nickname, :first_name, :last_name, :email, :password)";
        $stmt = $this->db->connection->prepare($sql);
        $stmt->bindParam(':nickname', $nickname);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        return $stmt->execute();
    }
    
}

