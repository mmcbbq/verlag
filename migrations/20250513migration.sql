DROP DATABASE if exists verlag;
create database verlag;

use verlag;

create table author
(
    id      int auto_increment PRIMARY KEY,
    fname   varchar(255),
    lname   varchar(255),
    bday    DATE,
    country varchar(255)
);

insert into author (fname, lname, bday, country)
VALUES ('Barack', 'Obama', '1961-08-01', 'USA'),
       ('Donald', 'Trump', '1946-06-14', 'USA');

create table book
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
);

insert into book (isbn, publication_date, pages, title, price, book.category, hardcover,author_id)
VALUES ('978-0399594496', '2015-10-06', 400, 'Art of the Deal', 10.89, 'Blabla',false,2),
       ('9783865914125','2009-06-15',256,'Yes We Can',5.00, 'Speech', true,1)

