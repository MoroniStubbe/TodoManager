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
        $accounts = [];

        if ($this->id !== null) {
            $accounts = $this->database->read($this->table, where: ["id" => $this->id]);
        } else if ($this->username !== "") {
            $accounts = $this->database->read($this->table, where: ["username" => $this->username]);
        }

        if(count($accounts) > 0){
            $account = $accounts[0];
            $this->id = $account["id"];
            $this->username = $account["username"];
            $this->password_hash = $account["password_hash"];
            return true;
        }

        return false;
    }

    //returns true on success
    public function create()
    {
        if ($this->username !== "" and $this->password !== "") {
            if (!$this->read()) {
                $this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
                $this->database->create(
                    $this->table,
                    [
                        "username" => $this->username,
                        "password_hash" => $this->password_hash
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
