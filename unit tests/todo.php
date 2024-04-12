<?php

require_once ("../php classes/todo.php");

require_once ("database.php");

$database_config = json_decode(file_get_contents("../database_config.json"));
$database = new Database($database_config);

$todo = new Todo($database);

$todo->text = "testText";

$todo->todo_list_id = 1;

$todo->create();

//$todo = $todo->read();
//
//$todo->update();
//
//$todo->delete();


