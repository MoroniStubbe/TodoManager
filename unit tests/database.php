<?php

include_once("../php classes/database.php");
$database = new Database("localhost", "todo_manager", "root", "");
$database->create("accounts", ["first_name"=> "asd", "last_name"=>"asd", "password_hash"=>"asd"]);