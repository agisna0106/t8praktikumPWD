<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db_pwdp8');

class Database {
    public $mysqli;

    function __construct() 
    {
        $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->mysqli->connect_errno){
            echo "<br/>Database tidak tersambung".$this->mysqli->error."<br/>";
        }

    }

    function select($table, $where = null) {
        $sql = ("SELECT * FROM $table");

        if ($where != null) {
            foreach ($where as $key => $value) {
                $sql .= " WHERE $key = '$value'";
            }
        }

        $result = $this->mysqli->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function insert($table, $rows) {
        $row = null;
        $value = null;

        foreach ($rows as $key => $nilai) {
            $row .= "," .$key;
            $value .= ",'" .$nilai. "'";
        }
        $sql = "INSERT INTO $table (". substr($row,1) .") VALUES (". substr($value,1) .")";
        $query = $this->mysqli->prepare($sql);
        $query->execute() or die($this->mysqli->error);
    }

    function update($table, $field, $where) {
        $set = null;
        $setWhere = null;
// 
        foreach ($field as $key => $value) {
            $set .= "," .$key. " = '" .$value. "' ";
        }
        foreach ($where as $key => $value) {
            $setWhere .= $key. " = " .$value;
        }
        $sql = "UPDATE $table SET " . substr($set, 1) . " WHERE $setWhere";
        echo $sql;
        $query = $this->mysqli->prepare($sql) or die($this->mysqli->error);
        $query->execute();
    }

    function delete($table) {
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $sql = "DELETE FROM $table WHERE id=$id";
            $query = $this->mysqli->prepare($sql) or die($this->mysqli->error);
            $query->execute();
        }
    }

    function __destruct()
    {
        $this->mysqli->close();
    }
}