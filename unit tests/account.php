<?php
include_once("database.php");
include_once("../php classes/account.php");

$account = new Account($database);
$account->username = "asd";
$account->password = "asd";
// $account->create();
// $account->read();