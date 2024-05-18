<?php
class Clientes {
    public $id_usu;
    public $nombre;
    public $email;
    public $contra;

    public function __construct($id_usu,$nombre, $email, $contra) {
        $this->id_usu=$id_usu;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->contra = $contra;
    }
}
