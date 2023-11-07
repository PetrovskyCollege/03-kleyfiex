<?php
class Database {
    public $conn;

    // Конструктор класса, устанавливаем соединение с бд
    public function __construct($server, $username, $password, $database) {

        $this->conn = new mysqli($server, $username, $password, $database);
        // Проверяем соединение
        if ($this->conn->connect_error) {
            die("Ошибка подключения: " . $this->conn->connect_error);
        }
    }

    // Метод для закрытия соединения с бд
    public function closeConnection() {
        $this->conn->close();
    }
}