<?php
// zum Einbinden der Klassen
spl_autoload_register(function ($className){
    //echo $className; die Klasse die gesucht wird
    $ordner = ['Entity','Repository']; // die Ordner in den gesucht werden soll
    foreach ($ordner as $od) {
        if (file_exists("src/$od/$className.php")){ // schaut ob es die Datei gibt
            include "src/$od/$className.php";
        }
    }
});


// index function
//$bookRepository = new BookRepository();
//
//$data = ['books'=>$bookRepository->findall()];
//include 'src/view/book/index.php';


// show function
//$bookRepository = new BookRepository();
//$data = ['book'=>$bookRepository->findById(1)];
//include 'src/view/book/show.php';


// delete function
//$bookRepository = new BookRepository();
//$book = $bookRepository->findById(5);
//$bookRepository->remove($book);
//$data = ['book'=>$book];
//include 'src/view/book/delete.php';


// create function

//$authorRepository = new AuthorRepository();
//$data = ['authoren'=>$authorRepository->findall()];
//if ($_SERVER['REQUEST_METHOD'] === 'GET'){
//    include 'src/view/book/create.php';
//}else{
//    $bookRepository = new BookRepository();
//    $book = new Book($_POST);
//    $bookRepository->create($book);
//    echo 'ist in der Datenbank';
//}


//edit function


//$authorRepository = new AuthorRepository();
//$bookRepository = new BookRepository();
//$data = ['authoren'=>$authorRepository->findall()];
//$data['book'] = $bookRepository->findById(2);
//if ($_SERVER['REQUEST_METHOD'] === 'GET'){
//    include 'src/view/book/update.php';
//}else{
//    $bookRepository = new BookRepository();
//    $book = $bookRepository->findById(2);
//    $book->setIsbn($_POST['isbn']);
//    $book->setPublicationDate(new DateTime($_POST['publication_date']));
//    $book->setPages($_POST['pages']);
//    $book->setTitle($_POST['title']);
//    $book->setPrice($_POST['price']);
//    $book->setCategory($_POST['category']);
//    $book->setHardcover($_POST['hardcover'] ?? false);
//    $book->setAuthor($authorRepository->findById($_POST['author_id']));
//
//    $bookRepository->update($book);
//    echo 'ist in der Datenbank';
//}







