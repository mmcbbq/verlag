<?php

class AuthorController extends AbstractController
{

    public function index(): void
    {
        $AuthorRepository = new AuthorRepository();
        $data = ['authors' => $AuthorRepository->findall()];
        include 'src/view/author/index.php';
    }

    public function show(int $id): void
    {
        $authorRepository = new AuthorRepository();
        $data = ['author' => $authorRepository->findById($id)];
        include 'src/view/author/show.php';
    }

    public function new(): void
    {

    }

    public function edit(int $id): void
    {
        // TODO: Implement edit() method.
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