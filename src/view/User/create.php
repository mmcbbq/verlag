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

$repo = new UserRepository();

$user = new User(['username'=>'admin']);
$repo->create($user);
