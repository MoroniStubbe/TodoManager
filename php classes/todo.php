<?php

class Todo
{
    private $database;
    public $title;
    public $text;
    public $dueDate;

    public function __construct($database)
    {
        $this->database = $database;
    }


    //returns true if text was created
    public function create()
    {
        $this->database->create(
            "todo",
            [
                "text" => $this->text
            ]
        );
    }


    public function read($id = null)
    {
        if ($id !== null) {
            // Als er een $id is opgegeven, haal dan alleen dat specifieke record op
            return $this->database->read("todo", ["*"], ["id" => $id]);
        } else {
            // Als er geen $id is opgegeven, haal dan alle records op
            return $this->database->read("todo");
        }
    }


    public function update($id, $columns = [])
    {
        if (count($columns) > 0) {
            // Zorg ervoor dat $id is ingesteld
            $this->id = $id;

            // Update alleen de opgegeven kolommen voor het record met de opgegeven $id
            $this->database->update("todo", $columns, ["id" => $this->id]);
        }
    }

    public function delete()
    {
        // Verwijder het record met de opgegeven $id
        $this->database->delete("todo", ["id" => $this->id]);
    }
}























