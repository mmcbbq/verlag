<?php
require_once '../vendor/autoload.php';



$db = new PDO("mysql:host=localhost;charset=utf8mb4", 'root', '');

$dropSQL = "DROP DATABASE if exists verlag;";

$createDB = 'CREATE DATABASE verlag';

$useSQL = 'USE verlag';

$createAuthor = "create table author
(
    id      int auto_increment PRIMARY KEY,
    fname   varchar(255),
    lname   varchar(255),
    bday    DATE,
    country varchar(255)
);";


$createBook ="create table book
(
    id               int auto_increment primary key,
    isbn             varchar(255),
    publication_date DATE,
    pages            int,
    title            varchar(255),
    price            double,
    category         varchar(255),
    hardcover        bool,
    author_id        int,
    foreign key (author_id) references author(id)
);";


$insertAuthor = "INSERT INTO author (fname, lname, bday, country)
    VALUES ( :fname, :lname, :bday,:country);";

$insertBook = "INSERT INTO book
    (isbn, publication_date, pages, title, price, category, hardcover, author_id)
    VALUES
        (:isbn, :publication_date, :pages, :title, :price, :category, :hardcover, :author_id);";

$db->exec($dropSQL);
$db->exec($createDB);
$db->exec($useSQL);
$db->exec($createAuthor);
$db->exec($createBook);


$faker = Faker\Factory::create();

$stmt = $db->prepare($insertAuthor);
for ($i = 0; $i < 20; $i++) {
    $fname = $faker->firstName();
    $lname = $faker->lastName();
    $bday = $faker->dateTimeBetween('-200 years','-30 years')->format('Y-m-d');
    $country = $faker->country();
    $data = [':fname'=>$fname,':lname'=>$lname,':bday'=>$bday,':country'=>$country];
//    $insertAuthor = "INSERT INTO author (fname, lname, bday, country)
//    VALUES ( :fname, :lname, :bday,:country);";
    $stmt->execute($data);
}


$stmt = $db->prepare($insertBook);
for ($i = 0; $i < 100; $i++) {
    $isbn = $faker->isbn13();
    $pub_date = $faker->dateTimeBetween('-200 years','-30 years')->format('Y-m-d');
    $pages = $faker->randomNumber(3);
    $price = $faker->randomFloat(2);
    $title = $faker->words(2,true);
    $category = $faker->word();
    $hardcover = $faker->boolean();
    $author_id = $faker->numberBetween(1,20);

    $bookdata = [':isbn'=>$isbn,
        ':publication_date'=>$pub_date,
        ':pages'=>$pages,
        ':price'=>$price,
        ':title'=>$title,
        ':category'=>$category,
        ':hardcover'=>$hardcover,
        ':author_id'=>$author_id];

    $stmt->execute($bookdata);
}