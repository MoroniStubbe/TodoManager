<?php

class Database
{
    public $host;
    public $dbname;
    public $pdo;
    public $tables;

    public function __construct($config)
    {
        try {
            $this->host = $config->host;
            $this->dbname = $config->dbname;
            $this->pdo = new PDO("mysql:host=" . $config->host . ";dbname=" . $config->dbname, $config->username, $config->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->tables = $this->get_database_structure();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //returns array of tables from database
    private function get_tables()
    {
        $sql = "SHOW TABLES";
        $statement = $this->pdo->query($sql);
        $tables = $statement->fetchAll(PDO::FETCH_COLUMN);
        return $tables;
    }

    //returns array of columns from a table
    private function get_columns($table)
    {
        $sql = "DESCRIBE $table";
        $statement = $this->pdo->query($sql);
        $columns = $statement->fetchAll(PDO::FETCH_COLUMN);
        return $columns;
    }

    //gets tables and columns of databse as assoc array
    public function get_database_structure()
    {
        $tables = $this->get_tables();
        $structure = [];
        foreach ($tables as $table) {
            $structure[$table] = $this->get_columns($table);
        }
        return $structure;
    }

    //returns true if table exists, else returns false
    private function check_table_exists($table)
    {
        if (in_array($table, array_keys($this->tables))) {
            return true;
        }
        return false;
    }

    //assumes table exists
    //returns true if column exists, else returns false
    private function check_column_exists($table, $column)
    {
        if (in_array($column, $this->tables[$table])) {
            return true;
        }
        return false;
    }

    //$column_value_pairs is an associative array: [column => value]
    public function create($table, $column_value_pairs)
    {
        if (!$this->check_table_exists($table)) {
            return "table not found";
        }

        $columns = array_keys($column_value_pairs);
        foreach ($columns as $column) {
            if (!$this->check_column_exists($table, $column)) {
                return "column not found";
            }
        }

        $columns_imploded = implode(", ", $columns);
        $placeholders = ":" . implode(', :', $columns);
        $sql = "INSERT INTO $table ($columns_imploded) VALUES ($placeholders)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($column_value_pairs);
    }

    //$where is an associative array: [column => value]
    //$where only works with simple equals operations
    //returns sql string
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

    //Selects all columns by default
    //Has no where clause by default
    //$where is an associative array: [column => value]
    //$where only works with simple equals operations
    public function read($table, $columns = ["*"], $where = [])
    {
        if (!$this->check_table_exists($table)) {
            return "table not found";
        }

        if ($columns !== ["*"]) {
            foreach ($columns as $column) {
                if (!$this->check_column_exists($table, $column)) {
                    return "column not found";
                }
            }
        }

        if ($where !== []) {
            $where_columns = array_keys($where);
            foreach ($where_columns as $column) {
                if (!$this->check_column_exists($table, $column)) {
                    return "column not found";
                }
            }
        }

        $columns_imploded = implode(", ", $columns);
        $where_sql = $this->create_where_clause($where);
        $sql = "SELECT " . $columns_imploded . " FROM " . $table . $where_sql;
        $statement = $this->pdo->prepare($sql);
        $statement->execute($where);
        $fetchAll = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $fetchAll;
    }

    //Has no where clause by default
    //$where is an associative array: [column => value]
    //$where only works with simple equals operations
    public function update($table, $column_value_pairs, $where = [])
    {
        if (!$this->check_table_exists($table)) {
            return "table not found";
        }

        $columns = array_keys($column_value_pairs);
        foreach ($columns as $column) {
            if (!$this->check_column_exists($table, $column)) {
                return "column not found";
            }
        }

        if ($where !== []) {
            $where_columns = array_keys($where);
            foreach ($where_columns as $column) {
                if (!$this->check_column_exists($table, $column)) {
                    return "column not found";
                }
            }
        }

        if (count($column_value_pairs) > 0) {
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
    }

    //Has no where clause by default
    //$where is an associative array: [column => value]
    //$where only works with simple equals operations
    public function delete($table, $where = [])
    {
        if (!$this->check_table_exists($table)) {
            return "table not found";
        }

        if ($where !== []) {
            $where_columns = array_keys($where);
            foreach ($where_columns as $column) {
                if (!$this->check_column_exists($table, $column)) {
                    return "column not found";
                }
            }
        }

        $where_sql = $this->create_where_clause($where);
        $sql = "DELETE FROM $table" . $where_sql;
        $statement = $this->pdo->prepare($sql);
        $statement->execute($where);
    }
}
