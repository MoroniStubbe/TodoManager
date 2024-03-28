<?php
include_once("database.php");
include_once("../php classes/account.php");

$account = new Account($database);
$account->username = "asd";
$account->password = "asdasdasdasd";

//Test create()
// $account->create();

//Test read()
// $account->read();

//Test log_in() and log_out()
// $account->password = "asd"; //wrong password
// $account->password = "asdasdasdasd"; //correct password
// $account->log_in();
// $account->log_out();

$a = 1; //to break here to read the var above