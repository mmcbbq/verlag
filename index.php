<?php

require_once 'vendor/autoload.php';


// Automatisches Laden von Klassen mit spl_autoload_register
spl_autoload_register(function ($className) {
    // Definieren der Ordner, in denen nach Klassen gesucht werden soll
    $ordner = ['Entity', 'Repository', 'Controller'];

    // Durchlaufen der definierten Ordner
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



// Erstellen einer Instanz des Controllers
$controller = new $controllerName;
if (!method_exists($controller, $method)) {
    $controller = new _404Controller();
    $method = 'index';
} else {
    $reflection = new ReflectionClass($controller);
    $anzahlparams = $reflection->getMethod($method)->getNumberOfParameters();
    if (isset($url[2]) and is_numeric($url[2])) {
        $index = [$url[2]];
    }else{
        $index = [];
    }


    if (($anzahlparams > 0 and !$index)) {
        $controller = new _404Controller();
        $method = 'index';
        $index = [];
    }
//
};
// Aufruf der Methode des Controllers mit dem gegebenen Parameter
call_user_func_array([$controller, $method], $index);










