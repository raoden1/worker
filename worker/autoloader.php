<?php 

//Autoloader klas
function class_autoloader($class) {

   // Zakłada się, że klasy są w './classes'
   $folders = array(
     '/clsses', '/classes/lib', './../../' 
   );
   $directories = array(
     'classes','lib',  ''
   );
   $dir = dirname(__FILE__);
   $theClass = '/' . $class . '.php';

   //Przeszukiwanie folderow i listy katalogow
   foreach($folders as $folder){
       foreach($directories as $directory){
          //Zmienna $theInclude zawiera PATH do klasy
           $theInclude = $dir.$folder.$directory.$theClass;
           //Sprawdzanie czy plik istnieje i dołączenie pliku z klasą, oba warunki muszą być spełnione by klasa
           // została załadowana.
           if (file_exists($theInclude) && include_once($theInclude)) {
              return TRUE;
           } 
       }
   }

  trigger_error("Ładowanie klasy lub pliku z nazwą klasy zakończone niepowodzeniem:  spl_autoload ", E_USER_WARNING);

  return FALSE;
}

spl_autoload_register('class_autoloader');

?>