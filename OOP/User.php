<?php

class User
{
    public $name;
    public $age;
    private $private;
    protected $legs = 123;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function getNameWithAge()
    {
        return $this->name . $this->age;
    }

    public function signin()
    {
        ///
    }

    public function signup()
    {
        ///
    }

    public function getFullName()
    {

    }


}

