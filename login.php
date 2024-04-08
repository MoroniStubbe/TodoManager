<?php
require_once("php classes/database.php");
require_once("php classes/account.php");

$database = new Database("localhost", "todo_manager", "root", "");
$account = new Account($database);
session_start();

if (isset($_SESSION["account"])) {
    $account->import($_SESSION["account"]);
}

if ($account->is_logged_in()) {
    echo file_get_contents("html templates/login.html");
}
