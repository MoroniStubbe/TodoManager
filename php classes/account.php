<?php
include_once("database.php");
class Account
{
    public $database;
    public $table = "accounts";
    public $id;
    public $username = "";
    public $password = "";

    public function __construct($database)
    {
        $this->database = $database;
    }
