<?php

spl_autoload_register(function ($className) {
$className = str_replace('\\', '/', $className);
$dirs = array_diff(scandir('../../'));
foreach ($dirs as $dir) {
    $fileName = stream_resolve_include_path( '../../'.$dir.'/'.$className . '.php');
    if ($fileName !== false) {
        include_once $fileName;
    }

}});

$repo = new AuthorRepository();
//$author = $repo->findById(2);
$bookrepo = new BookRepository();
$book = $bookrepo->findById(1);

?>


<!doctype html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport'
          content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>Document</title>
</head>
<body>
<?php



echo $book->getTitle();
echo '<br>';
echo 'by ' .$book->getAuthor()->getLname();
echo '<br>';
echo 'erschienen ' .$book->getPublicationDate()->format('d-m-Y');
?>
</body>
</html>

