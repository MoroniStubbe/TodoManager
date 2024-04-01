<?php
//for now we use $_GET instead of $_POST just to test the functions
//TODO: replace $_GET for $_POST
include_once("php classes/database.php");
$database = new Database("localhost", "todo_manager", "root", "");

switch ($_GET["action"]) {
    case "create":
        include_once("php classes/account.php");
        $account = new Account($database);
        $account->set_username($_GET["username"]);
        $account->set_password($_GET["password"]);
        $account->create();
}
