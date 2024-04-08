<?php

require_once("database.php");

class todo
{
    private $database;
    private $id;
    public $text;

    public function __construct($database)
    {
        $this->database = $database;
    }

    //returns true if account was found
    public function read($id = null, $username = "")
    {
        $todo = [];

        if ($id !== null) {
            $todo = $this->database->read("todo", where: ["id" => $id]);
        } else if ($username !== "") {
            $accounts = $this->database->read("todo", where: ["username" => $username]);
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
        $this->database->create(
            "todo",
            [
                "text" => $this->text
            ]
        );
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

        $this->database->update("todo", $column_value_pairs, ["id" => $this->id]);
    }

    public function delete()
    {
        if ($this->logged_in) {
            $this->database->delete("text", ["id" => $this->id]);
            return true;
        }

        return false;
    }
}




















