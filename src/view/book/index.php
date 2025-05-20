<?php
$books = $data['books']
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
$count = 0;
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
    echo $book->getIsbn();
    echo $book->getAuthor()->getLname();
    echo '<br>';
    echo '<br>';
    echo '</div>';
}
?>
</body>
</html>
