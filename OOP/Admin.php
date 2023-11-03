<?php
include_once "User.php";

class Admin extends User
{
    public function getSome(){
        return $this->legs;
    }

}

$admin = new Admin("admin", 123);
var_dump($admin->getSome());