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

$controller = new AuthorController();
//$controller->index();
//$controller->show(2);
$controller->delete(4);
//$controller->new();
//$controller->edit(8);













