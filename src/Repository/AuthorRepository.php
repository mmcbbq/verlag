<?php

class AuthorRepository
{

    public function Dbcon():PDO
    {
        return new PDO("mysql:host=localhost;dbname=verlag;charset=utf8mb4", 'root', '');
    }

    public function findall():array
    {
        $dbcon = $this->Dbcon();
        $sql = 'SELECT * FROM author';
        $stm = $dbcon->prepare($sql);
        $stm->execute();
        $return = [];
        foreach ( $stm->fetchAll(PDO::FETCH_ASSOC) as $item) {
            $return[] = new Author($item['bday'],$item['country'],$item['fname'],$item['lname'],$item['id']);

        }
        return $return;

    }


    public function findById(int $id)
    {
        $dbcon = $this->Dbcon();
        $sql = 'SELECT * FROM author where id = :id';
        $stm = $dbcon->prepare($sql);
        $stm->bindParam(':id',$id);
        $stm->execute();
        $data = $stm->fetch(PDO::FETCH_ASSOC);

        return new Author($data['bday'],$data['country'],$data['fname'],$data['lname'],$data['id']);
    }

    public function remove(Author $author):bool
    {
        $id = $author->getId();
        $dbcon = $this->Dbcon();
        $sql = "DELETE FROM author where id = :id";
        $stm = $dbcon->prepare($sql);
        $stm->bindParam(':id',$id);
        return $stm->execute();
    }

    public function update(Author $author):Author
    {
        $data = [':fname'=> $author->getFname(),':lname'=>$author->getLname(),':bday'=>$author->getBday()->format('Y-m-d'),':country'=>$author->getCountry(),':id'=>$author->getId()];
        $dbcon = $this->Dbcon();
        $sql = 'UPDATE author set fname=:fname, lname= :lname, bday = :bday, country = :country where id = :id';
        $stm = $dbcon->prepare($sql);
        $stm->execute($data);
        return $this->findById($author->getId());
    }

    public function create(Author $author):Author
    {
        $data = [':fname'=> $author->getFname(),':lname'=>$author->getLname(),':bday'=>$author->getBday()->format('Y-m-d'),':country'=>$author->getCountry()];
        $dbcon = $this->Dbcon();
        $sql = 'INSERT INTO author ( fname, lname, bday, country) values (:fname, :lname, :bday, :country)';
        $stm = $dbcon->prepare($sql);
        $stm->execute($data);
        $id = (int)$dbcon->lastInsertId();
        return $this->findById($id);

    }

}



