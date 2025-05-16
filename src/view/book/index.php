<?php

spl_autoload_register(function ($className) {
    $className = str_replace('\\', '/', $className);
    $dirs = array_diff(scandir('../../'));
    foreach ($dirs as $dir) {
        $fileName = stream_resolve_include_path( '../../'.$dir.'/'.$className . '.php');
        if ($fileName !== false) {
            include_once $fileName;
        }

    }
});

$repo = new AuthorRepository();
//$author = $repo->findById(2);
$bookrepo = new BookRepository();

$book = new Book('sdffs',true,'sdafsdf',123,18.00,'2000-02-01','super',1,);
$updateBook = $bookrepo->findById(4);
$updateBook->setIsbn('2r-9-35729864590687345906');
$books = $bookrepo->update($updateBook);

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
$count =0;
foreach ($books as $book) {
    if ($count % 2 == 0){
        $color = 'red';
    } else{
        $color = 'blue';
    }
    $count++;

    echo "<div style='background-color: $color'>";
    echo $book->getTitle();
    echo '<br>';
    echo $book->getAuthor()->getLname();
    echo '<br>';
    echo '<br>';
    echo '</div>';
}
?>
</body>
</html>
