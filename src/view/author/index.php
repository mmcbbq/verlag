<?php
include '../../Entity/Author.php';
include '../../Entity/Book.php';
include '../../Repository/AuthorRepository.php';
include '../../Repository/BookRepository.php';

$repo = new AuthorRepository();
$authoren = $repo->findall();


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
Hallo welt
</body>
</html>
