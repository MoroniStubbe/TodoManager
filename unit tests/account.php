<?php
include_once("database.php");
include_once("../php classes/account.php");

$account = new Account($database);
// $account->set_username("asd");
// $account->set_password("asdasdasdasd");

//Test create()
// $account->create();

//Test read()
$account->read(username: "asd");

//Test update()
// $account->set_username("qwe");
// $account->set_password("qweqweqweqwe");
// $account->update();

//Test log_in()
// $account->log_in("asd"); //wrong password
$account->log_in("qweqweqweqwe"); //correct password

//Test delete()
$account->delete();

//Test log_out()
// $account->log_out();

$a = 1; //to break here to read the var above