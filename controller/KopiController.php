<?php
require_once __DIR__ . '/../model/Database.php';

class KopiController {
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllKopi () {
        return $this->db->select('kopi');
    }

    public function addKopi($data) {
        return $this->db->insert('kopi', $data);
    }

    public function updateKopi($data, $id) {
        return $this->db->update('kopi', $data, $id);
    }

    public function deleteKopi() {
        return $this->db->delete('kopi');
    }
}

