<?php
require_once 'vendor/autoload.php';
// zum Einbinden der Klassen
spl_autoload_register(function ($className){
    //echo $className; die Klasse die gesucht wird
    $ordner = ['Entity','Repository','Controller']; // die Ordner in den gesucht werden soll
    foreach ($ordner as $od) {
        // Prüfen, ob die Datei für die gesuchte Klasse im aktuellen Ordner existiert
        if (file_exists("src/$od/$className.php")) {
            // Wenn ja, Datei einbinden
            include "src/$od/$className.php";
        }
    }
});

// Aufspalten der aktuellen URL in Segmente
// Entfernt den Pfad "/verlag/" aus der URL und teilt den Rest anhand von "/"
$url = explode('/', str_ireplace('/verlag/', '', $_SERVER['REQUEST_URI']));
$url = array_diff($url, ['']);
// Ermitteln des Controller-Namens aus dem ersten URL-Segment
$controllerName = isset($url[0]) ? $url[0] . 'Controller' : 'HomeController';
$controllerName = file_exists("src/Controller/$controllerName.php") ? $controllerName : '_404Controller';
// Ermitteln der Methode aus dem zweiten URL-Segment
$method = $url[1] ?? 'index';

// Drittes URL-Segment als Parameter übergeben (z.B. eine ID), standardmäßig ein leerer Array
$index = isset($url[2]) ? [$url[2]] : [];

// Erstellen einer Instanz des Controllers
$controller = new $controllerName;
if (!method_exists($controller, $method)) {
    $controller = new _404Controller();
    $method = 'index';
} else {
    $reflection = new ReflectionClass($controller);
    $anzahlparams = $reflection->getMethod($method)->getNumberOfParameters();
    if (($anzahlparams > 0 and !$index) or !is_numeric($index)){
        $controller = new _404Controller();
        $method = 'index';
    }

};
// Aufruf der Methode des Controllers mit dem gegebenen Parameter
call_user_func_array([$controller, $method], $index);










