<?php
$authoren = $data['authoren'];
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
    isbn: <input type='text' name='isbn'><br>
    title: <input type='text' name='title'><br>
    category: <input type='text' name='category'><br>
    pages: <input type='number' name='pages'><br>
    price: <input type='number' name='price'><br>
    Datum: <input type='date' name='publication_date'><br>
    Hardcover: <input type='checkbox' name='hardcover'><br>
    <select name="author_id" >
        <?php
        foreach ($authoren as $author) {
            echo "<option value='".$author->getId()."'>".$author->getFname()." ".$author->getLname()."</option>";
        }
        ?>
    </select>
    <input type='submit'>
</form>
</body>
</html>




