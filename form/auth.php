<?php
session_start();
echo $_SESSION['userName'];
?>
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
include_once '../DB/DB.php';
$db = new DB("test", "localhost");
$connect = $db->connect();

if (isset($_POST["formSend"])) {
    if (empty($_POST["login"]) || empty($_POST["pass"])) {
        echo '<div class="alert alert-danger" role="alert"> Error: введите логин и пароль</div>';

    } else {
        $row = $connect->query("SELECT * FROM `user` WHERE `login` = {$_POST["login"]} AND `password` = {$_POST["pass"]}");
        $user = $row->fetch();
        echo '<div class="alert alert-success" role="alert">Привет, ' . $user["name"] . '</div>';
        $_SESSION['userName'] = $user["name"];
    }


    function printAllUsers($connect)
    {
        echo "Пользователи: <br>";
        foreach ($connect->query('SELECT * from user') as $row) {
            echo $row["login"] . " - " . $row["password"] . "<br>";
        }
    }

    printAllUsers($connect);

}
