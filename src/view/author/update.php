<?php
$author = $data["author"];
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
<form  method='post'>
    fname: <input type='text' name='fname' value='<?php echo $author->getFname() ?>'>
    lname: <input type='text' name='lname' value='<?php echo $author->getLname() ?>'>
    bday: <input type='date' name='bday' value='<?php echo $author->getBday()->format('Y-m-d') ?>'>
    country: <input type='text' name='country' value='<?php echo $author->getCountry() ?>'>
    <input type='submit'>

</form>
</body>
</html>



