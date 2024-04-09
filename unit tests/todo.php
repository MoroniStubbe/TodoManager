<?php

require_once ("database.php");

require_once ("../php classes/todo.php");

$database = new Database("localhost", "todo_manager", "root", "");

$todo = new Todo($database);

$todo->text = "testText";



$todo->create();
