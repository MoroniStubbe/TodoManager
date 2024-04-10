<?php
require_once("php classes/account.php");

$database_config = json_decode(file_get_contents("database_config.json"));
$database = new Database($database_config);
$account = new Account($database);
session_start();

if (isset($_SESSION["account"])) {
    $account->import($_SESSION["account"]);
}

if (!$account->is_logged_in()) {
    echo file_get_contents("html templates/login.html");
}