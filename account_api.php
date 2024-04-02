<?php

//for now we use $_GET instead of $_POST just to test the functions
//TODO: replace $_GET for $_POST
if (isset($_GET["action"])) {
    require_once("php classes/database.php");
    require_once("php classes/account.php");

    session_start();
    $database = new Database("localhost", "todo_manager", "root", "");
    $account = new Account($database);

    if (isset($_SESSION["account"])) {
        $account->import($_SESSION["account"]);
    }

    switch ($_GET["action"]) {
        case "create":
            if (isset($_GET["username"]) and isset($_GET["password"])) {
                $account->set_username($_GET["username"]);
                $account->set_password($_GET["password"]);
                $account->create();
            }

            $_SESSION["account"] = $account->export();
            break;

        case "log_in":
            if (isset($_GET["username"]) and isset($_GET["password"])) {
                $account->set_username($_GET["username"]);
                $account->log_in($_GET["password"]);
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
            if (isset($_GET["username"])) {
                $account->change_username($_GET["username"]);
            }

            $_SESSION["account"] = $account->export();
            break;

        case "change_password":
            if (isset($_GET["password"])) {
                $account->change_password($_GET["password"]);
            }

            $_SESSION["account"] = $account->export();
            break;
    }
    
    //for debugging only
    //TODO: remove echo
    echo json_encode($account->export());
}
