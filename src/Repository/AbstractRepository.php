<?php

abstract class AbstractRepository
{
    public function Dbcon(): PDO
    {
        return new PDO("mysql:host=localhost;dbname=verlag;charset=utf8mb4", 'root', '');
    }
    public function query($sql, $data = []):array|false
    {
        $dbcon = $this->Dbcon();
        $stm = $dbcon->prepare($sql);
        $result = $stm->execute($data);
        $return = $stm->fetchALL(PDO::FETCH_ASSOC);
        $id = $dbcon->lastInsertId();
        if ($id){
            $return= ['id'=>(int)$id];
        }
        if ($result){
            return $return;
        }else
        {
            return false;
        }


    }

}