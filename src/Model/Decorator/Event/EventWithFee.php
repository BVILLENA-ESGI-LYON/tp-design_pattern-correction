<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Model\Decorator\Event;

final readonly class EventWithFee implements EventInterface
{
    public function __construct(
        private EventInterface $event,
        private int $fee,
    ) {
    }

    public function getFee(): int
    {
        return $this->fee;
    }

    public function getLabel(): string
    {
        return $this->event->getLabel();
    }

    public function getDescription(): string
    {
        return "{$this->event->getDescription()}\nCoût de participation : {$this->fee} €.";
    }

    public function getDate(): \DateTime
    {
        return $this->event->getDate();
    }
}
