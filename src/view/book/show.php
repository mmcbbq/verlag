<?php
$book = $data['book']
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
echo 'Seiten Anzahl'.$book->getPages();
?>
</body>
</html>

