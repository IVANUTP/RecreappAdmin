<?php
require '../../vendor/autoload.php'; 
use Cloudinary\Configuration\Configuration;
// Incluye el cargador automático de Composer

Configuration::instance([
   'cloud'=>[
    "CLOUDINARY_URL" => "cloudinary://939351518356477:IfvlCFlSegLvObT1fZuG5WQh7ME@dpn9zcwzw", 
    "CLOUDINARY_UPLOAD_PRESET" => "939351518356477", 
    "CLOUDINARY_NOTIFICATION_URL" => "9IfvlCFlSegLvObT1fZuG5WQh7ME"
   ]
]);

