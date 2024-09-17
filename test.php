<?php
     require 'vendor/autoload.php';

     use Intervention\Image\ImageManagerStatic as Image;

     // Cambia a la ruta correcta de la imagen
     $img = Image::make('C:/laragon/www/devstagram/public/img/login.jpg');
     $img->fit(1000, 1000);
     echo "Intervention Image está funcionando.";
