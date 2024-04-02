<?php
//for now we use $_GET instead of $_POST just to test the functions
//TODO: replace $_GET for $_POST
require_once("php classes/database.php");
$database = new Database("localhost", "todo_manager", "root", "");
require_once("php classes/account.php");
$account = new Account($database);

switch ($_GET["action"]) {
    case "create":
        $account->set_username($_GET["username"]);
        $account->set_password($_GET["password"]);
        $account->create();

    case "log_in":
        $account->log_in($_GET["password"]);
}
