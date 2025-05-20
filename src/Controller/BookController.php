<?php

class BookController extends AbstractController
{

    public function index(): void
    {
        $bookRepository = new BookRepository();
        $data = ['books' => $bookRepository->findall()];
        include 'src/view/book/index.php';
    }

    public function show(int $id): void
    {
        $bookRepository = new BookRepository();
        $data = ['book' => $bookRepository->findById($id)];
        include 'src/view/book/show.php';
    }

    public function new(): void
    {
        $authorRepository = new AuthorRepository();
        $data = ['authoren' => $authorRepository->findall()];
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            include 'src/view/book/create.php';
        } else {
            $bookRepository = new BookRepository();
            $book = new Book($_POST);
            $bookRepository->create($book);
            echo 'ist in der Datenbank';
        }
    }

    public function edit(int $id): void
    {
        $authorRepository = new AuthorRepository();
        $bookRepository = new BookRepository();
        $data = ['authoren' => $authorRepository->findall()];
        $data['book'] = $bookRepository->findById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            include 'src/view/book/update.php';
        } else {
            $bookRepository = new BookRepository();
            $book = $bookRepository->findById($id);
            $book->setIsbn($_POST['isbn']);
            $book->setPublicationDate(new DateTime($_POST['publication_date']));
            $book->setPages($_POST['pages']);
            $book->setTitle($_POST['title']);
            $book->setPrice($_POST['price']);
            $book->setCategory($_POST['category']);
            $book->setHardcover($_POST['hardcover'] ?? false);
            $book->setAuthor($authorRepository->findById($_POST['author_id']));

            $bookRepository->update($book);
            echo 'ist in der Datenbank';
        }
    }

    public function delete(int $id): void
    {
        $bookRepository = new BookRepository();
        $book = $bookRepository->findById($id);
        $bookRepository->remove($book);
        $data = ['book' => $book];
        include 'src/view/book/delete.php';
    }
}