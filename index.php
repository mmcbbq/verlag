<?php
// zum Einbinden der Klassen
spl_autoload_register(function ($className){
    //echo $className; die Klasse die gesucht wird
    $ordner = ['Entity','Repository','Controller']; // die Ordner in den gesucht werden soll
    foreach ($ordner as $od) {
        if (file_exists("src/$od/$className.php")){ // schaut ob es die Datei gibt
            include "src/$od/$className.php";
        }
    }
});




$url = explode('/',str_ireplace('/verlag/','',$_SERVER['REQUEST_URI']));
$controllerName = $url[0].'Controller';
$method = $url[1];
$index = [(int)$url[2]] ?? [];


$controller = new $controllerName;
call_user_func_array([$controller,$method],$index);
//var_dump($controller);

//"author/index/"
//"author/show/1"
//"author/delete/1"
//"author/edit/1"
//"author/new/"

















