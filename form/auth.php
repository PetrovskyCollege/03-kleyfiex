<!-- <?php
session_start();
echo $_SESSION['userName'];
?> -->
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Title</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
              crossorigin="anonymous">
    </head>
    <body>

    <form method="POST">
        <div class="row">
            <div class="col-md-3">
                <label for="login" class="form-label">Логин</label>
                <input name="login" id="login" type="text" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <label for="pass" class="form-label">Пароль</label>
                <input name="pass" id="pass" type="password" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <button name="formSend" type="submit" class="btn btn-primary">Войти</button>
            </div>
        </div>
    </form>
    </body>
    </html>
<?php
session_start();

include_once '../DB/DB.php';
include_once '../OOP/User.php'; // Подключаем файл с классом User

$db = new DB("games_app_dump", "localhost");
$pdo = $db->getPdoConnection(); // Получаем объект PDO

$userHandler = new User($db);

if (isset($_POST["formSend"])) {
    if (empty($_POST["login"]) || empty($_POST["pass"])) {
        echo '<div class="alert alert-danger" role="alert">Ошибка: введите логин и пароль</div>';
    } else {
        $username = $_POST["login"];
        $password = $_POST["pass"];

        if ($userHandler->login($username, $password)) {
            echo '<div class="alert alert-success" role="alert">Привет, ' . $username . '</div>';
            $_SESSION['userName'] = $username;
            printAllUsers($db->getPdoConnection());
        } else {
            echo '<div class="alert alert-danger" role="alert">Ошибка входа</div>';
        }
    }
}


function printAllUsers($connect)
{
    echo "Пользователи: <br>";
    $stmt = $connect->prepare('SELECT * FROM user');
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo $row["nickname"] . " - " . $row["password"] . "<br>";
    }
}



