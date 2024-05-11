<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Model\Decorator\Event;

final readonly class EventWithLocation implements EventInterface
{
    public function __construct(
        private EventInterface $event,
        private string $address,
        private string $postalCode,
        private string $city,
    ) {
    }

    public function getLocation(): string
    {
        return "{$this->address} {$this->postalCode} {$this->city}";
    }

    public function getLabel(): string
    {
        return "[{$this->city}] {$this->event->getLabel()}";
    }

    public function getDescription(): string
    {
        return "{$this->event->getDescription()}\nLocalisation : {$this->getLocation()}";
    }

    public function getDate(): \DateTime
    {
        return $this->event->getDate();
    }
}
