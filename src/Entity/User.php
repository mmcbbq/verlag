<?php

class User implements EntityInterface
{
    private ?int $id;
    private string $username;

    /**
     * @param int $id
     * @param string $username
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->username = $data['username'];
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }


    public function mapToArray(): array
    {
        return [':id' => $this->id,
            ':username' => $this->username];
    }
}