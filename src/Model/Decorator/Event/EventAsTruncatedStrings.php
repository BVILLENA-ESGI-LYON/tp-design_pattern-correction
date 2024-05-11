<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Model\Decorator\Event;

final readonly class EventAsTruncatedStrings implements EventInterface
{
    public function __construct(
        private EventInterface $event,
        private int $labelMaxLength,
        private int $descriptionMaxLength,
    ) {
    }

    public function getLabel(): string
    {
         return $this->getTruncated(string: $this->event->getLabel(), maxLength: $this->labelMaxLength);
    }

    public function getDescription(): string
    {
        return $this->getTruncated(
            string: $this->event->getDescription(),
            maxLength: $this->descriptionMaxLength
        );
    }

    public function getDate(): \DateTime
    {
        return $this->event->getDate();
    }

    private function getTruncated(string $string, int $maxLength): string
    {
        if ($maxLength <= 0 || mb_strlen($string) <= $maxLength) {
            return $string;
        }

        return $maxLength <= 3
            ? mb_strcut(string: $string, start: 0, length: $maxLength)
            : mb_strcut(string: $string, start: 0, length: $maxLength - 3) . '...';
    }
}
