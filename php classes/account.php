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
    public $logged_in = false;

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

        if (count($accounts) > 0) {
            $account = $accounts[0];
            $this->id = $account["id"];
            $this->username = $account["username"];
            $this->password_hash = $account["password_hash"];
            return true;
        }

        return false;
    }

    //returns true if password is valid
    public function validate_password()
    {
        if (strlen($this->password) > 11 and !str_contains($this->password, " ")) {
            return true;
        }

        return false;
    }

    //returns true if account was created
    public function create()
    {
        if ($this->username !== "" and $this->validate_password() and !$this->read()) {
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
    }

    public function update($columns)
    {
        $column_value_pairs = [];

        if(in_array("username", $columns)){
            $column_value_pairs["username"] = $this->username;
        }

        if(in_array("password_hash", $columns)){
            $column_value_pairs["password_hash"] = $this->password_hash;
        }

        $this->database->update($this->table, $column_value_pairs, ["id" => $this->id]);
    }

    //returns true if login was successful
    public function log_in()
    {
        if (!$this->logged_in and $this->read() and password_verify($this->password, $this->password_hash)) {
            $this->logged_in = true;
            return true;
        }

        return false;
    }

    public function log_out(){
        $this->logged_in = false;
    }
}
