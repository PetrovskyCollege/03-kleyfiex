<?php

class User {
    public $db;

    // Конструктор класса User
    public function __construct(Database $db) {
        $this->db = $db;
    }

    // Метод для входа
    public function login($username, $password) {
        // Эскейпим введенные данные
        $username = $this->db->conn->real_escape_string($username);
        $password = $this->db->conn->real_escape_string($password);

        // Выполняем запрос к бд для проверки аутентификации
        $sql = "SELECT * FROM user WHERE nickname = '$username' AND password = '$password'";
        $result = $this->db->query($sql);

        if ($result->num_rows === 1) {
            // Пользователь вошел
            return true;
        } else {
            // Пользователь не смог войти
            return false;
        }
    }

    public function register($nickname, $first_name, $last_name, $email, $password) {
        // Эскейпим введенные данные
        $nickname = $this->db->conn->real_escape_string($nickname);
        $first_name = $this->db->conn->real_escape_string($first_name);
        $last_name = $this->db->conn->real_escape_string($last_name);
        $email = $this->db->conn->real_escape_string($email);
        $password = $this->db->conn->real_escape_string($password);
    
        // Выполняем запрос к бд для регистрации
        $sql = "INSERT INTO user (nickname, first_name, last_name, email, password) 
                VALUES ('$nickname', '$first_name', '$last_name', '$email', '$password')";
    
        if ($this->db->query($sql)) {
            // Регистрация прошла успешно
            return true;
        } else {
            // Ошибка при регистрации
            return false;
        }
    }
    
}

