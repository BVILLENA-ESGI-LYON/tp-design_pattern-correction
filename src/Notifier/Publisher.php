<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Notifier;

final class Publisher
{
    public function __construct(
        private ObserverRegistry $observerRegistry
    ) {
    }


    public function notify(NotifierEnum $notifier, mixed $data): void
    {
        foreach ($this->observerRegistry->getObservers($notifier) as $observer) {
            $observer->handleNotifier(type: $notifier, data: $data);
        }
    }
}
