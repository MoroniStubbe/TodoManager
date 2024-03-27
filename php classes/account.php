<?php
include_once("database.php");
class Account
{
    public $database;
    public $table = "accounts";
    public $id;
    public $username = "";
    public $password = "";
    public $password_hash = "";

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

    //returns true on success
    public function create()
    {
        if ($this->username !== "" and $this->password !== "") {
            if ($this->read()) {
                $this->database->create(
                    $this->table,
                    [
                        "username" => $this->username,
                        "password_hash" => password_hash($this->password, PASSWORD_DEFAULT)
                    ]
                );
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
