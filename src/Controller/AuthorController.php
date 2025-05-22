<?php

class AuthorController extends AbstractController
{

    public function index(): void
    {
        $AuthorRepository = new AuthorRepository();
        $loader = new \Twig\Loader\FilesystemLoader('src/view/author');
        $twig = new \Twig\Environment($loader);

        $data = ['authors' => $AuthorRepository->findall()];


        echo $twig->render('index.html.twig', $data);





//        include 'src/view/author/index.php';
    }

    public function show(int $id): void
    {
        $authorRepository = new AuthorRepository();
        $data = ['author' => $authorRepository->findById($id)];
        include 'src/view/author/show.php';
    }

    public function new(): void
    {

//        $authorRepository = new AuthorRepository();
//        $data = ['authoren' => $authorRepository->findall()];
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            include 'src/view/author/create.php';
        } else {
            $authorRepository = new AuthorRepository();
            $author = new Author($_POST);
            $authorRepository->create($author);
            echo 'ist in der Datenbank';
        }

    }

    public function edit(int $id): void
    {
        $authorRepository = new AuthorRepository();
        $bookRepository = new BookRepository();
        $data = ['author' => $authorRepository->findById($id)];
//        $data['book'] = $bookRepository->findById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            include 'src/view/author/update.php';
        } else {
            $entity = $authorRepository->findById($id);
            $entity->setFname($_POST['fname']);
            $entity->setLname($_POST['lname']);
            $entity->setBday(new DateTime($_POST['bday']));
            $entity->setCountry($_POST['country']);
            $authorRepository->update($entity);
            echo 'ist in der Datenbank';
        }
    }

    public function delete(int $id): void
    {
        $authorRepository = new AuthorRepository();
        $author = $authorRepository->findById($id);
        $authorRepository->remove($author);
        $data = ['book' => $author];
        include 'src/view/author/delete.php';
    }
}