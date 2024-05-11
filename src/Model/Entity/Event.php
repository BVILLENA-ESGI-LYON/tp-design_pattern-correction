<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Model\Entity;

use EsgiIw\TpDesignPattern\Model\Decorator\Event\EventInterface;
use EsgiIw\TpDesignPattern\Model\Entity\Enum\Event\EventTypeEnum;

class Event implements EventInterface
{
    protected int $id;

    protected string $label;

    protected string $description;

    protected \DateTime $date;

    protected EventTypeEnum $type = EventTypeEnum::REGULAR;

    protected ?int $remainingSeats = null;

    protected ?int $remainingBdeReservedSeats = null;

    private array $changeSet = [];

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;
        $this->changeSet['id'] = true;

        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;
        $this->changeSet['label'] = true;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        $this->changeSet['description'] = true;

        return $this;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): static
    {
        $this->date = $date;
        $this->changeSet['date'] = true;

        return $this;
    }

    public function getType(): EventTypeEnum
    {
        return $this->type;
    }

    public function setType(EventTypeEnum $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getRemainingSeats(): ?int
    {
        return $this->remainingSeats;
    }

    public function setRemainingSeats(?int $remainingSeats): static
    {
        $this->remainingSeats = $remainingSeats;

        return $this;
    }

    public function getRemainingBdeReservedSeats(): ?int
    {
        return $this->remainingBdeReservedSeats;
    }

    public function setRemainingBdeReservedSeats(?int $remainingBdeReservedSeats): static
    {
        $this->remainingBdeReservedSeats = $remainingBdeReservedSeats;

        return $this;
    }

    public function hasChanged(?string $propertyName = null): bool
    {
        return $propertyName === null
            ? count($this->changeSet) > 0
            : array_key_exists(key: $propertyName, array: $this->changeSet);
    }

    public function resetChangeSet(): void
    {
        $this->changeSet = [];
    }
}
