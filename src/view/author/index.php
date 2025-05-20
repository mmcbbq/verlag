<?php
$authoren = $data['authors']
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
<div>
<?php
foreach ($authoren as $author) {
    echo '<div>';
    echo 'Vorname: '. $author->getFname();
    echo '<br>';
    echo 'Nachname: '. $author->getLname();
    echo '</div>';
}
?>
</div>
</body>
</html>
