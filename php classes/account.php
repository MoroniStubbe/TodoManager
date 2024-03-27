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

    //returns true if account was found
    public function read()
    {
        $account = [];

        if ($this->id !== null) {
            $account = $this->database->read($this->table, where: ["id" => $this->id])[0];
            $this->username = $account["username"];
            return true;
        } else if ($this->username !== "") {
            $account = $this->database->read($this->table, where: ["username" => $this->username])[0];
            $this->id = $account["id"];
            return true;
        }

        return false;
    }
}
