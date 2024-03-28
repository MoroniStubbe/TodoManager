<?php

class Todo
{
    public $title;
    public $description;
    public $dueDate;

    public function __construct($title, $description, $dueDate)
    {
        $this->title = $title;
        $this->description = $description;
        $this->dueDate = $dueDate;
    }
}