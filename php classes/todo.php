<?php

class Todo
{
    public $id;
    private $database;
    public $title;
    public $text;
    public $dueDate;
    public $todo_list_id;


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
                "text" => $this->text,
                "todo_list_id" => $this->todo_list_id

            ]
        );
    }


    public function read($id = null)
    {
        if ($id !== null) {
            return $this->database->read("todo", ["*"], ["id" => $id]);
        } else {
            return $this->database->read("todo");
        }
    }


    public function update($id, $columns = [])
    {
        if (count($columns) > 0) {
            $this->id = $id;

            // Update alleen de opgegeven kolommen voor het record met de opgegeven $id
            $this->database->update("todo", $columns, ["id" => $this->id]);
        }
    }

    public function delete()
    {
        // Controleer of $this->id is ingesteld voordat je het gebruikt
        if ($this->id !== null) {
            // Verwijder het record met de opgegeven $id
            $this->database->delete("todo", ["id" => $this->id]);
        } else {
            // Geef een foutmelding of neem andere gepaste actie als $this->id niet is ingesteld
            // Dit is een voorbeeld, je kunt dit aanpassen aan jouw behoeften
            echo "Kan geen todo verwijderen zonder ID.";
        }
    }
}























