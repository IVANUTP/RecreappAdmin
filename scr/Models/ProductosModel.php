<?php

 class Productos{

   public $id; 
   public $nombre;
   public $marca;
   public $modelo;
   public  $precio;
   public $descripcion;
   public $img;
   
   
   public function __construct($id,$nombre,$marca,$modelo,$precio,$descripcion,$img){
      $this->id=$id;
      $this->nombre=$nombre;
      $this->marca=$marca;
      $this->modelo=$modelo;
      $this->precio=$precio;
      $this->descripcion=$descripcion;
      $this->img=$img;
   }
 }
