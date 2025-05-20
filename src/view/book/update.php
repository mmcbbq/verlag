<?php
$authoren = $data['authoren'];
$book = $data['book'];
$check = '';
if ($book->isHardcover()){
    $check = 'checked';
}
//var_dump($book);
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
<form action='index.php' method='post'>
    isbn: <input type='text' name='isbn' value='<?php echo $book->getIsbn() ?>'><br>
    title: <input type='text' name='title' value='<?php echo $book->getTitle() ?>' ><br>
    category: <input type='text' name='category' value='<?php echo $book->getCategory() ?>'><br>
    pages: <input type='number' name='pages' value='<?php echo $book->getPages() ?>'><br>
    price: <input type='number' name='price' value='<?php echo $book->getPrice() ?>'><br>
    Datum: <input type='date' name='publication_date' value='<?php echo $book->getPublicationDate()->format('Y-m-d') ?>'><br>
    Hardcover: <input type='checkbox' name='hardcover' <?php echo $check ?>><br>
    <select name="author_id" >
        <?php
        foreach ($authoren as $author) {
            if($book->getAuthor()->getId() === $author->getId()){
                echo "<option value='".$author->getId()."' selected >".$author->getFname()." ".$author->getLname()."</option>";
            }else{
                echo "<option value='".$author->getId()."'>".$author->getFname()." ".$author->getLname()."</option>";
            }
        }
        ?>
    </select>
    <input type='submit'>
</form>
</body>
</html>

