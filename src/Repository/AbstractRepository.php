<?php

abstract class AbstractRepository
{
    public function Dbcon(): PDO
    {
        return new PDO("mysql:host=localhost;dbname=verlag;charset=utf8mb4", 'root', '');
    }
    public function query($query, $data =[]):array


}