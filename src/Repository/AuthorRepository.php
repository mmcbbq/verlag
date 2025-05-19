<?php

class AuthorRepository extends AbstractRepository
{

    protected string $tablename = "Author";

    /**
     * @return Author
     */



    public function update(Author $author):Author
    {
        $sql = 'UPDATE author set fname=:fname, lname= :lname, bday = :bday, country = :country where id = :id';
        $this->query($sql,$data);
        return $this->findById($author->getId());
    }

    public function create(Author $author):Author
    {
        $data = [':fname'=> $author->getFname(),':lname'=>$author->getLname(),':bday'=>$author->getBday()->format('Y-m-d'),':country'=>$author->getCountry()];
        $sql = 'INSERT INTO author ( fname, lname, bday, country) values (:fname, :lname, :bday, :country)';
        $result = $this->query($sql,$data);
        return $this->findById($result['id']);
    }
}



