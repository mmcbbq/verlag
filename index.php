<?php
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

// Ermitteln des Controller-Namens aus dem ersten URL-Segment
$controllerName = $url[0] . 'Controller';

// Ermitteln der Methode aus dem zweiten URL-Segment
$method = $url[1];

// Drittes URL-Segment als Parameter übergeben (z. B. eine ID), standardmäßig ein leerer Array
$index = [(int)$url[2]] ?? [];

// Erstellen einer Instanz des Controllers
$controller = new $controllerName;

// Aufruf der Methode des Controllers mit dem gegebenen Parameter
call_user_func_array([$controller, $method], $index);










