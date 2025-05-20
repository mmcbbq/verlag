<?php

class Author implements EntityInterface
{
    private ?int $id;
    private string $fname;
    private string $lname;
    private DateTime $bday;
    private string $country;

    private array $books;

    /**
     * @param DateTime $bday
     * @param string $country
     * @param string $fname
     * @param int|null $id
     * @param string $lname
     */
    public function __construct(array $data)
    {
        $this->bday = new DateTime($data['bday']);
        $this->country = $data['country'];
        $this->fname = $data['fname'];
        $this->id = $data['id'] ?? null;
        $this->lname = $data['lname'];
        $bookrepo = new BookRepository();
        $this->books = $bookrepo->findByAuthor($this);
    }

    public function getBday(): DateTime
    {
        return $this->bday;
    }

    public function setBday(DateTime $bday): void
    {
        $this->bday = $bday;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getFname(): string
    {
        return $this->fname;
    }

    public function setFname(string $fname): void
    {
        $this->fname = $fname;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getLname(): string
    {
        return $this->lname;
    }

    public function setLname(string $lname): void
    {
        $this->lname = $lname;
    }

    public function getBooks(): array
    {
        return $this->books;
    }

    public function setBooks(array $books): void
    {
        $this->books = $books;
    }

    public function getBooksObj()
    {
        $bookrepo = new BookRepository();
        $books = [];
        foreach ($this->getBooks() as $bookid){
            $books[] = $bookrepo->findById($bookid);
        }
        return $books;
    }


    public function mapToArray():array
    {
        return [':fname'=> $this->getFname(),':lname'=>$this->getLname(),':bday'=>$this->getBday()->format('Y-m-d'),':country'=>$this->getCountry(),':id'=>$this->getId()];

    }

}

