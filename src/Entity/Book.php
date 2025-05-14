<?php

class Book
{

    private ?int $id;
    private string $isbn;
    private DateTime $publicationDate;
    private int $pages;
    private string $title;
    private float $price;
    private string $category;
    private bool $hardcover;
    private Author $author;

    /**
     * @param string $category
     * @param bool $hardcover
     * @param int $id
     * @param string $isbn
     * @param int $pages
     * @param float $price
     * @param DateTime $publicationDate
     * @param string $title
     */
    public function __construct(string $category, bool $hardcover , string $isbn, int $pages, float $price, string $publicationDate, string $title, int $author_id,?int $id = null)
    {
        $this->category = $category;
        $this->hardcover = $hardcover;
        $this->id = $id;
        $this->isbn = $isbn;
        $this->pages = $pages;
        $this->price = $price;
        $this->publicationDate = new DateTime($publicationDate);
        $this->title = $title;
        $repo = new AuthorRepository();
        $this->author = $repo->findById($author_id);
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): void
    {
        $this->isbn = $isbn;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function setAuthor(Author $author): void
    {
        $this->author = $author;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function isHardcover(): bool
    {
        return $this->hardcover;
    }

    public function setHardcover(bool $hardcover): void
    {
        $this->hardcover = $hardcover;
    }

    public function getPages(): int
    {
        return $this->pages;
    }

    public function setPages(int $pages): void
    {
        $this->pages = $pages;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getPublicationDate(): DateTime
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(DateTime $publicationDate): void
    {
        $this->publicationDate = $publicationDate;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getId(): int
    {
        return $this->id;
    }


}