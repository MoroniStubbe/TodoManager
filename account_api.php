<?php
require_once("php classes/database.php");
require_once("php classes/account.php");

session_start();
$database = new Database("localhost", "todo_manager", "root", "");
$account = new Account($database);

if (isset($_SESSION["account"])) {
    $account->import($_SESSION["account"]);
}

//for now we use $_GET instead of $_POST just to test the functions
//TODO: replace $_GET for $_POST
switch ($_GET["action"]) {
    case "create":
        $account->set_username($_GET["username"]);
        $account->set_password($_GET["password"]);
        $account->create();

    case "log_in":
        $account->log_in($_GET["password"]);
}

$_SESSION["account"] = $account->export();
