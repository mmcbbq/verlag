<?php

abstract class AbstractRepository
{
    protected string $tablename;

    public function Dbcon(): PDO
    {
        return new PDO("mysql:host=localhost;dbname=verlag;charset=utf8mb4", 'root', '');
    }

    public function query($sql, $data = []): array|false
    {
        $dbcon = $this->Dbcon();
        $stm = $dbcon->prepare($sql);
        $result = $stm->execute($data);
        $return = $stm->fetchALL(PDO::FETCH_ASSOC);
        $id = $dbcon->lastInsertId();
        if ($id) {
            $return = ['id' => (int)$id];
        }
        if ($result) {
            return $return;
        } else {
            return false;
        }

    }

    public function findall(): array
    {
        $sql = "SELECT * FROM $this->tablename";
        $return = [];
        foreach ($this->query($sql) as $item) {
            $return[] = new $this->tablename(
                $item);
        }
        return $return;

    }

    public function findById(int $id):Object
    {

        $sql = "SELECT * FROM $this->tablename where id = :id";
        $sqldata = [':id'=>$id];
        $data = $this->query($sql,$sqldata)[0];
        return new $this->tablename($data);
    }


    public function remove(Object $obj):bool
    {

        $sql = "DELETE FROM $this->tablename where id = :id";
        $data = [':id'=>$obj->getId()];
        $result = $this->query($sql,$data);
        return ($result === []);

    }



    public function update(Book $book):Book
    {
        $data = [':isbn'=>$book->getIsbn(),':publication_date'=>$book->getPublicationDate()->format('Y-m-d'),'pages'=>$book->getPages(),'title'=>$book->getTitle(),'price'=>$book->getPrice(),'category'=>$book->getCategory(),'hardcover'=>$book->isHardcover(),'author_id'=>$book->getAuthor()->getId(),'id'=>$book->getId()];

        $sql = 'UPDATE book set isbn = :isbn, publication_date= :publication_date, pages = :pages, title = :title, price = :price, category =:category, hardcover= :hardcover, author_id = :author_id where id = :id';

        $this->query($sql,$data);
        return $this->findById($book->getId());
    }

}