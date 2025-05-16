<?php

class AuthorRepository extends AbstractRepository
{
    /**
     * @return Author[]
     */
    public function findall():array
    {
        $sql = 'SELECT * FROM author';
        $return = [];
        foreach ($this->query($sql) as $item) {
            $return[] = new Author(
                $item['bday'],
                $item['country'],
                $item['fname'],
                $item['lname'],
                $item['id']);
        }
        return $return;

    }
    public function findById(int $id)
    {
        $sql = 'SELECT * FROM author where id = :id';
        $sqldata = [':id'=>$id];
        $data = $this->query($sql,$sqldata)[0];
        return new Author($data['bday'],$data['country'],$data['fname'],$data['lname'],$data['id']);
    }
    public function remove(Author $author):bool
    {

        $sql = "DELETE FROM author where id = :id";
        $data = [':id'=>$author->getId()];
        $result = $this->query($sql,$data);
        return ($result === []);

    }

    public function update(Author $author):Author
    {
        $data = [':fname'=> $author->getFname(),':lname'=>$author->getLname(),':bday'=>$author->getBday()->format('Y-m-d'),':country'=>$author->getCountry(),':id'=>$author->getId()];
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



