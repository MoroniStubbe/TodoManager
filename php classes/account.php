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
        if ($this->username !== "" and $this->password_hash !== "" and !$this->read(username: $this->username)) {
            $this->database->create(
                "accounts",
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

        if (in_array("username", $columns)) {
            $column_value_pairs["username"] = $this->username;
        }

        if (in_array("password_hash", $columns)) {
            $column_value_pairs["password_hash"] = $this->password_hash;
        }

        $this->database->update("accounts", $column_value_pairs, ["id" => $this->id]);
    }

    public function export()
    {
        return ["id" => $this->id, "username" => $this->username, "password_hash" => $this->password_hash];
    }

    //only use with data from export()
    public function import($import_data)
    {
        $this->id = $import_data["id"];
        $this->username = $import_data["username"];
        $this->password_hash = $import_data["password_hash"];
    }

    //returns true if username was set
    public function set_username($username)
    {
        if ($username !== "") {
            $backup = $this->export();

            if (!$this->read(username: $username)) {
                $this->username = $username;
                return true;
            }

            $this->import($backup);
        }

        return false;
    }

    //returns true if password is valid
    public function set_password($password)
    {
        if (strlen($password) > 11 and !str_contains($password, " ")) {
            $this->password_hash = password_hash($password, PASSWORD_DEFAULT);
            return true;
        }

        return false;
    }

    //returns true if login was successful
    public function log_in($password)
    {
        if (!$this->logged_in and $this->read($this->id) and password_verify($password, $this->password_hash)) {
            $this->logged_in = true;
            return true;
        }

        return false;
    }

    public function log_out()
    {
        $this->logged_in = false;
    }
}
