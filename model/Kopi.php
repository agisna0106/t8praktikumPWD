<?php
require_once 'Database.php';

class Kopi {
    public $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function tampil($table) {
        return $this->db->select($table);
    }
}