<?php
include_once("database.php");
include_once("../php classes/account.php");

$account = new Account($database);
$account->username = "asd";
$account->password = "asd";

//Test create()
// $account->create();

//Test read()
// $account->read();

//Test log_in()
// $account->password = "asd";
// $account->log_in();

//$a = 1;