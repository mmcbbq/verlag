<?php

class AuthorRepository extends AbstractRepository
{

    protected string $tablename = "Author";




    public function create(Author $author):Author
    {
        $data = [':fname'=> $author->getFname(),':lname'=>$author->getLname(),':bday'=>$author->getBday()->format('Y-m-d'),':country'=>$author->getCountry()];
        $sql = 'INSERT INTO author ( fname, lname, bday, country) values (:fname, :lname, :bday, :country)';
        $result = $this->query($sql,$data);
        return $this->findById($result['id']);
    }
}



