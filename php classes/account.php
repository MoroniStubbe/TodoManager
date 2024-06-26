<?php
require_once("database.php");
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

    //returns empty string by default
    //error returns: "account not found"
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
            return "";
        }

        return "account not found";
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
        return ["id" => $this->id, "username" => $this->username, "password_hash" => $this->password_hash, "logged_in" => $this->logged_in];
    }

    //only use with data from export()
    public function import($import_data)
    {
        $this->id = $import_data["id"];
        $this->username = $import_data["username"];
        $this->password_hash = $import_data["password_hash"];
        $this->logged_in = $import_data["logged_in"];
    }

    //returns empty string by default
    //error returns: "no username", "username already taken"
    public function set_username($username)
    {
        if ($username !== "") {
            $backup = $this->export();

            $error = $this->read(username: $username);
            if ($error === "") {
                $this->import($backup);
                return "username already taken";
            }

            $this->username = $username;
            return "";
        }

        return "no username";
    }

    //returns empty string by default
    //error returns: "not logged in", "no username", "username already taken"
    public function change_username($username)
    {
        if (!$this->logged_in) {
            return "not logged in";
        }

        $error = $this->set_username($username);
        if ($error !== "") {
            return $error;
        }

        $this->update(["username"]);
        return "";
    }

    //returns empty string by default
    //error returns: "password too short"
    public function set_password($password)
    {
        if (strlen($password) > 11) {
            $this->password_hash = password_hash($password, PASSWORD_DEFAULT);
            return "";
        }

        return "password too short";
    }

    //returns empty string by default
    //error returns: "not logged in", "password too short"
    public function change_password($password)
    {
        if (!$this->logged_in) {
            return "not logged in";
        }

        $error = $this->set_password($password);
        if ($error !== "") {
            return $error;
        }

        $this->update(["password_hash"]);
        return "";
    }

    //returns empty string by default
    //error returns: "no username", "username already taken", "password too short"
    public function create($username, $password)
    {
        $error = $this->set_username($username);
        if ($error !== "") {
            return $error;
        }

        $error = $this->set_password($password);
        if ($error !== "") {
            return $error;
        }

        $this->database->create(
            "accounts",
            [
                "username" => $this->username,
                "password_hash" => $this->password_hash
            ]
        );
        return "";
    }

    //returns empty string by default
    //error returns: "already logged in", "wrong username", "wrong password"
    public function log_in($username, $password)
    {
        if ($this->logged_in) {
            return "already logged in";
        }

        $error = $this->read(username: $username);
        if ($error !== "") {
            return "wrong username";
        }

        if (!password_verify($password, $this->password_hash)) {
            return "wrong password";
        }

        $this->logged_in = true;
        return "";
    }

    public function is_logged_in()
    {
        return $this->logged_in;
    }

    //returns empty string by default
    //error returns: "not logged in"
    public function log_out()
    {
        if ($this->logged_in) {
            $this->logged_in = false;
            return "";
        }

        return "not logged in";
    }

    //returns empty string by default
    //error returns: "not logged in"
    public function delete()
    {
        $error = $this->log_out();
        if ($error !== "") {
            return $error;
        }

        $this->database->delete("accounts", ["id" => $this->id]);
        return "";
    }
}
