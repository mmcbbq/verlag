<?php
include '../../Repository/AbstractRepository.php';
include '../../Entity/Author.php';
include '../../Entity/Book.php';
include '../../Repository/AuthorRepository.php';
include '../../Repository/BookRepository.php';
$repo = new AuthorRepository();
$author = $repo->findById(2);
$bookrepo = new BookRepository();

$data['author']
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
echo $author->getFname();
echo '</div>';

echo '<div>';
foreach ($author->getBooks() as $bookid){
    $book = $bookrepo->findById($bookid);
    echo '<div> '. $book->getTitle() .'</div>';
}
echo '</div>'
?>
</body>
</html>
