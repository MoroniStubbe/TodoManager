<?php
include_once("database.php");
class Account
{
    private $database;
    private $id;
    private $username = "";
    private $password_hash = "";
    private $logged_in = false;

    public function __construct($database)
    {
        $this->database = $database;
    }

    //returns true if account was found
    public function read($id = null, $username = "")
    {
        $accounts = [];

        if ($id !== null) {
            $accounts = $this->database->read("accounts", where: ["id" => $id]);
        } else if ($username !== "") {
            $accounts = $this->database->read("accounts", where: ["username" => $username]);
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

    //updates all columns by default
    //input can be contain one of: ["username", "password_hash"]
    public function update($columns = ["username", "password_hash"])
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
