<?php

class Database
{
    public $host;
    public $dbname;
    public $pdo;

    public function __construct($host, $dbname, $username, $password)
    {
        try {
            $this->host = $host;
            $this->dbname = $dbname;
            $this->pdo = new PDO("mysql:host=" . $host . ";dbname=" . $dbname, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //column_value_pairs is an associative array: [column => value]
    public function create($table_name, $column_value_pairs)
    {
        $columns = array_keys($column_value_pairs);
        $columns_imploded = implode(", ", $columns);
        $placeholders_imploded = ":" . implode(", :", $columns);
        $sql = "INSERT INTO $table_name ($columns_imploded) VALUES ($placeholders_imploded)";
        $statement = $this->pdo->prepare($sql);

        foreach ($column_value_pairs as $column => &$value) {
            $statement->bindParam(':' . $column, $value);
        }

        $statement->execute();
    }

    public function read()
    {
    }

    public function update()
    {
    }

    public function delete()
    {
    }
}
