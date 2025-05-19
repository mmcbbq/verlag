<?php

class BookRepository extends AbstractRepository
{

    protected string $tablename = 'Book';

    /**
     * @param Author $author
     * @return Book[]
     */
    public function findByAuthor(Author $author): array
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
            $return[] = $item['id'];
        }

        return $return;

    }
}
