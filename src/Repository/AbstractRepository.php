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

    /**
     * @return EntityInterface[]
     */
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

    /**
     * @param int $id
     * @return EntityInterface
     */
    public function findById(int $id): EntityInterface
    {

        $sql = "SELECT * FROM $this->tablename where id = :id";
        $sqldata = [':id' => $id];
        $data = $this->query($sql, $sqldata)[0];
        return new $this->tablename($data);
    }


    public function remove(object $obj): bool
    {

        $sql = "DELETE FROM $this->tablename where id = :id";
        $data = [':id' => $obj->getId()];
        $result = $this->query($sql, $data);
        return ($result === []);

    }


    public function update(EntityInterface $obj): EntityInterface
    {
        $data = $obj->mapToArray();
        $keys = array_keys($data);
        $string = ''; //':fname', ':lname' -> 'fname = :fname, lname = :lname'
        foreach ($keys as $index => $key) {
            if ($key === ':id') {
                continue;
            }
            $spalte = str_replace(':', '', $key);
            $string .= "$spalte = $key, ";

        }
        $string = rtrim($string, ', ');

        $sql = "UPDATE $this->tablename set $string where id = :id";

        $this->query($sql, $data);
        return $this->findById($obj->getId());
    }

    public function create(EntityInterface $entity): EntityInterface
    {
        $data = $entity->mapToArray();
        unset($data[':id']);
        $keys = array_keys($data);
        $spalte = '';
        $placeholder = '';
        foreach ($keys as $key) {
            if ($key === ':id') {
                continue;
            }
            $spalte .= str_replace(':', '', $key) . ', ';
            $placeholder .= "$key, ";
        }
        $spalte = rtrim($spalte, ', ');
        $placeholder = rtrim($placeholder, ', ');
        $sql = "INSERT INTO $this->tablename ( $spalte ) values ( $placeholder )";
        $result = $this->query($sql, $data);
        return $this->findById($result['id']);
    }
}