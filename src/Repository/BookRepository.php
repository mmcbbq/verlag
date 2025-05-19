<?php

class BookRepository extends AbstractRepository
{

    protected string $tablename = 'Book';

    /**
     * @return Book[]
     */

    public function create(Book $book): Book
    {
        $data = [':isbn'=>$book->getIsbn(),
            ':publication_date'=>$book->getPublicationDate()->format('Y-m-d'),
            ':pages'=>$book->getPages(),'title'=>$book->getTitle(),
            ':price'=>$book->getPrice(),'category'=>$book->getCategory(),
            ':hardcover'=>$book->isHardcover(),
            ':author_id'=>$book->getAuthor()->getId()];

        $sql = 'INSERT INTO book (
                  isbn,
                  publication_date,
                  pages,
                  title, price,
                  category, hardcover,
                  author_id ) values (
                                      :isbn,
                                      :publication_date,
                                      :pages,
                                      :title,
                                      :price,
                                      :category,
                                      :hardcover,
                                      :author_id)';


        $result = $this->query($sql,$data);
        return $this->findById($result['id']);
    }





    /**
     * @param Author $author
     * @return Book[]
     */
    public function findByAuthor(Author $author):array
    {
        $id = $author->getId();
        $dbcon = $this->Dbcon();
        $sql = 'SELECT * FROM book where author_id = :author_id';
        $stm = $dbcon->prepare($sql);
        $stm->bindParam(':author_id', $id);
        $stm->execute();
        $data = $stm->fetchAll(PDO::FETCH_ASSOC);
        $return = [];
        foreach ($data as $item) {
            $return[]=$item['id'];
        }

        return $return;


    }


}
//include '../Entity/Author.php';
//include '../Entity/Book.php';
//include 'AuthorRepository.php';
//$repo = new BookRepository();
//$authrepo = new AuthorRepository();
//$book = $repo->findById(46);
//$repo->remove($book);
//test find all
//var_dump($repo->findall());
//test
//var_dump($repo->findById(2));

//test create


//$book = new Book('category', true, 'isbn1', 200, 19.00, '2025-02-02', 'super', 2);
//$authrepo->findById(1);
//$repo->create($book);
//var_dump($book->getAuthor());



//test update


//$book_uupdate = $repo->findById(45);
//$book_uupdate->setTitle("hallo update");
//var_dump($book_uupdate);
//$repo->update($book_uupdate);

//test getbyAuthor
//$author = $authrepo->findById(2);
//var_dump($author->getBooks());
//$books = $repo->findByAuthor($author);
//var_dump($books[0]->getTitle());

