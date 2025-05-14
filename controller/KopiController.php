<?php
require_once 'model/Kopi.php';

class KopiController {
    private $kopi;
    public function __construct()
    {
        $kopi = new Kopi();
    }
    
    public function exportToJson($filename = 'dataKopi.json') {
        $data = $this->kopi->tampil('kopi');
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents($filename, $json);
        return $filename;
    }
}

