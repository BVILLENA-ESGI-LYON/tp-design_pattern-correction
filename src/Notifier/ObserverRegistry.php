<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Notifier;

final class ObserverRegistry
{
    /**
     * @var array<string, array<ObserverInterface>>
     */
    private array $observers = [];

    public function addObserver(NotifierEnum $notifier, ObserverInterface $observer): static
    {
        $this->observers[$notifier->name] ??= [];
        $this->observers[$notifier->name][] = $observer;

        return $this;
    }

    /**
     * @return array<ObserverInterface>
     */
    public function getObservers(NotifierEnum $notifier): array
    {
        return $this->observers[$notifier->name] ?? [];
    }
}
