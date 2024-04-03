<?php

//the api echos an error if something went wrong

header("Content-Type: application/json");
$input = json_decode(file_get_contents('php://input'));

if (isset($input->action)) {
    require_once("php classes/database.php");
    require_once("php classes/account.php");

    session_start();
    $database = new Database("localhost", "todo_manager", "root", "");
    $account = new Account($database);

    if (isset($_SESSION["account"])) {
        $account->import($_SESSION["account"]);
    }

    $error = "";

    switch ($input->action) {
        case "create":
            if (isset($input->username) and isset($input->password)) {
                $error = $account->create($input->username, $input->password);
            }

            $_SESSION["account"] = $account->export();
            break;

        case "log_in":
            if (isset($input->username) and isset($input->password)) {
                $account->set_username($input->username);
                $account->log_in($input->password);
            }

            $_SESSION["account"] = $account->export();
            break;

        case "log_out":
            $account->log_out();
            session_destroy();
            break;

        case "delete":
            $account->delete();
            session_destroy();
            break;

        case "change_username":
            if (isset($input->username)) {
                $account->change_username($input->username);
            }

            $_SESSION["account"] = $account->export();
            break;

        case "change_password":
            if (isset($input->password)) {
                $account->change_password($input->password);
            }

            $_SESSION["account"] = $account->export();
            break;
    }

    echo $error;
}
