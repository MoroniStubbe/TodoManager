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

    //$where is an associative array: [column => value]
    //$where only works with simple equals operations
    //returns both sql and bound values
    private function create_where_clause($where)
    {
        if (count($where) > 0) {
            $where_conditions = [];

            foreach ($where as $column => $value) {
                $where_conditions[] = "$column = :$column";
            }

            $where_conditions_imploded = implode(" AND ", $where_conditions);
            return " WHERE " . $where_conditions_imploded;
        } else {
            return "";
        }
    }

    //WARNING: This function is vulnerable to sql injection if table, columns or where_columns are set by user
    //Selects all columns by default
    //Has no where clause by default
    //$where is an associative array: [column => value]
    //$where only works with simple equals operations
    public function read($table, $columns = ["*"], $where = [])
    {
        $columns_imploded = implode(", ", $columns);
        $where_sql = $this->create_where_clause($where);
        $sql = "SELECT " . $columns_imploded . " FROM " . $table . $where_sql;
        $statement = $this->pdo->prepare($sql);
        $statement->execute($where);
        $fetchAll = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $fetchAll;
    }

    //WARNING: This function is vulnerable to sql injection if table, set_columns or where_columns are set by user
    //Has no where clause by default
    //$where is an associative array: [column => value]
    //$where only works with simple equals operations
    public function update($table, $column_value_pairs, $where = [])
    {
        $sets = [];

        foreach ($column_value_pairs as $column => $value) {
            $sets[] = "$column = :$column";
        }
        
        $set_sql = implode(", ", $sets);
        $where_sql = $this->create_where_clause($where);
        $sql = "UPDATE $table SET $set_sql" . $where_sql;
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array_merge($column_value_pairs, $where));
    }

    public function delete()
    {
    }
}
