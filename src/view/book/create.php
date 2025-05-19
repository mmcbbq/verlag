<?php
spl_autoload_register(function ($className) {
    $className = str_replace('\\', '/', $className);
    $dirs = array_diff(scandir('../../'));
    foreach ($dirs as $dir) {
        $fileName = stream_resolve_include_path('../../' . $dir . '/' . $className . '.php');
        if ($fileName !== false) {
            include_once $fileName;
        }

    }
});


$repo = new BookRepository();
$author = $repo->findById(2);
$author->setTitle('New Create');
$repo->create($author);



