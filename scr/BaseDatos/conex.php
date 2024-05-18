<?php 

 class Conex{
   public static function conexion(){

        $server="localhost";
        $user="root";
        $password="";
        $dbname="recreapp";


        $conex=mysqli_connect($server,$user,$password,$dbname);

        if($conex->connect_error){
           die("Conexion fallida". $conex->connect_error);
        }
        return $conex;
   }
 }
 
?>