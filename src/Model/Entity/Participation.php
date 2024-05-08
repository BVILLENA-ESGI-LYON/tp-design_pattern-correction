<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Model\Entity;

class Participation
{
    protected int $id;

    protected Event $event;

    protected Person $person;

    protected \DateTime $registrationAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function getEvent(): Event
    {
        return $this->event;
    }

    public function setEvent(Event $event): static
    {
        $this->event = $event;

        return $this;
    }

    public function getPerson(): Person
    {
        return $this->person;
    }

    public function setPerson(Person $person): static
    {
        $this->person = $person;

        return $this;
    }

    public function getRegistrationAt(): \DateTime
    {
        return $this->registrationAt;
    }

    public function setRegistrationAt(\DateTime $registrationAt): static
    {
        $this->registrationAt = $registrationAt;

        return $this;
    }
}
