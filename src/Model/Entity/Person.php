<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Model\Entity;

class Person
{
    protected int $id;
    
    protected string $firstName;
    
    protected string $lastName;

    protected bool $validatedAccount = false;

    protected bool $bdeMember = false;

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function isValidatedAccount(): bool
    {
        return $this->validatedAccount;
    }

    public function setValidatedAccount(bool $validatedAccount): static
    {
        $this->validatedAccount = $validatedAccount;

        return $this;
    }

    public function isBdeMember(): bool
    {
        return $this->bdeMember;
    }

    public function setBdeMember(bool $bdeMember): static
    {
        $this->bdeMember = $bdeMember;

        return $this;
    }
}
