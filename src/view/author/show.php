<?php

$author = $data['author']
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
echo '<div>';
echo 'Vorname: '.$author->getFname().'<br>';
echo 'Nachname: '.$author->getLname().'<br>';
echo '</div>';

echo '<div>';
echo 'Books:<br>';
foreach ($author->getBooksObj() as $item) {
    echo $item->getTitle();
    echo '<br>';
}
echo '</div>'
?>
</body>
</html>
