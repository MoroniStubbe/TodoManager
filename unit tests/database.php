<?php

include_once("../php classes/database.php");
$database = new Database("localhost", "todo_manager", "root", "");

//Test create()
// $database->create("accounts", ["first_name"=> "asd", "last_name"=>"asd", "password_hash"=>"asd"]);

// Test read()
// $accounts = $database->read("accounts", ["first_name", "last_name"], ["id" => 3]);
// print($accounts[0]["first_name"] . " " . $accounts[0]["last_name"]);

//Test update()
// $database->update("accounts", ["first_name" => "qwe", "last_name" => "qwe"], ["id" => 3]);
