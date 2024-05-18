<?php
class Usuarios
{
    public $id;
    public $nombre;
    public $email;
    public $password;
    public $nombre_rol;

    public function __construct($id, $nombre, $email, $password, $nombre_rol) {
        $this->id=$id;
        $this->nombre=$nombre;
        $this->email=$email;
        $this->password=$password;
        $this->nombre_rol=$nombre_rol;
    }

}
