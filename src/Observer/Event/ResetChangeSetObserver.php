<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Observer\Event;

use EsgiIw\TpDesignPattern\Model\Entity\Event;
use EsgiIw\TpDesignPattern\Notifier\NotifierEnum;
use EsgiIw\TpDesignPattern\Notifier\ObserverInterface;

final class ResetChangeSetObserver implements ObserverInterface
{
    public function handleNotifier(NotifierEnum $type, mixed $data): void
    {
        if ($data instanceof Event === false) {
            return;
        }

        echo "\n> -----";
        echo "\n> " . static::class;
        echo "\n> - Event::resetChangeSet()";
        $data->resetChangeSet();
        echo "\n> -----";
    }
}
