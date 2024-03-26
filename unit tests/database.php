<?php

include_once("../php classes/database.php");
$database = new Database("localhost", "todo_manager", "root", "");

// $database->create("accounts", ["first_name"=> "asd", "last_name"=>"asd", "password_hash"=>"asd"]);

$account = $database->read("accounts", ["first_name", "last_name"], ["id = 3"])[0];
print($account["first_name"] . " " . $account["last_name"]);
