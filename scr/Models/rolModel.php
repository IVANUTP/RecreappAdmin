<?php 

class Roles {
    public $id;
    public $nombre;

    public function __construct($id, $nombre) {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    public function setId($id) {
        $this->id = $id;
    }
}



