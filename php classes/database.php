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

    //WARNING: This function is vulnerable to sql injection if table and columns are set by user
    //$column_value_pairs is an associative array: [column => value]
    public function create($table, $column_value_pairs)
    {
        $columns = array_keys($column_value_pairs);
        $columns_imploded = implode(", ", $columns);
        $placeholders = ":" . implode(', :', $columns);
        $sql = "INSERT INTO $table ($columns_imploded) VALUES ($placeholders)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($column_value_pairs);
    }

    //WARNING: This function is vulnerable to sql injection if table, columns or where_columns are set by user
    //Selects all columns by default
    //Has no where clause by default
    //$where is an associative array: [column => value]
    //$where only works with simple equals operations
    public function read($table, $columns = ["*"], $where = [])
    {
        $columns_imploded = implode(", ", $columns);
        $sql = "SELECT " . $columns_imploded . " FROM " . $table;

        if (count($where) > 0) {
            $where_conditions = [];
            $where_columns = array_keys($where);
            foreach ($where_columns as $where_column) {
                $where_conditions[] = "$where_column = :$where_column" . "_value";
            }
            $where_conditions_imploded = implode(" AND ", $where_conditions);
            $sql .= " WHERE " . $where_conditions_imploded;
        }

        $statement = $this->pdo->prepare($sql);
        $where_values = [];
        foreach ($where as $column => $value) {
            $where_values[$column . "_value"] = $value;
        }
        $statement->execute($where_values);
        $fetchAll = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $fetchAll;
    }

    public function update()
    {
    }

    public function delete()
    {
    }
}
