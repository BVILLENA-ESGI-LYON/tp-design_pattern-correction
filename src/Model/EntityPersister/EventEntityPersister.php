<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Model\EntityPersister;

use EsgiIw\TpDesignPattern\Model\Entity\Event;
use EsgiIw\TpDesignPattern\Notifier\NotifierEnum;
use EsgiIw\TpDesignPattern\Notifier\Publisher;

final readonly class EventEntityPersister
{
    public function __construct(
        private Publisher $publisher
    ) {
    }

    public function updateEvent(Event $event): void
    {
        if ($event->hasChanged() === false) {
            return;
        }

        echo "\nBefore updateEvent()...";
        $this->publisher->notify(notifier: NotifierEnum::ENTITY_EVENT_UPDATE_BEFORE, data: $event);
        echo "\n... Before updateEvent() OK!";

        echo "\n\n-----\n";

        echo "\nMise à jour table « event » :";
        echo <<<SQL
            UPDATE event
            SET   {$this->getFieldSqlUpdates($event)}
            WHERE id = :id
            SQL;
        $this->defineUpdateParameters($event);
        echo "\n* Paramètre :id => {$event->getId()}";

        echo "\n\n-----\n";

        echo "\nAfter updateEvent()...";
        $this->publisher->notify(notifier: NotifierEnum::ENTITY_EVENT_UPDATE_AFTER, data: $event);
        echo "\n... After updateEvent() OK!";
    }

    private function getFieldSqlUpdates(Event $event): string
    {
        $sqlUpdates = [];
        if ($event->hasChanged(propertyName: 'label')) {
            $sqlUpdates[] = 'label = :label';
        }
        if ($event->hasChanged(propertyName: 'description')) {
            $sqlUpdates[] = 'description = :description';
        }
        if ($event->hasChanged(propertyName: 'date')) {
            $sqlUpdates[] = 'date = :date';
        }

        return implode(separator: "\n    , ", array: $sqlUpdates);
    }

    private function defineUpdateParameters(Event $event): void
    {
        if ($event->hasChanged(propertyName: 'label')) {
            echo "\n* Paramètre :label => {$event->getLabel()}";
        }
        if ($event->hasChanged(propertyName: 'description')) {
            echo "\n* Paramètre :description => {$event->getDescription()}";
        }
        if ($event->hasChanged(propertyName: 'date')) {
            echo "\n* Paramètre :date => {$event->getDate()->format('Y-m-d H:i')}";
        }
    }
}
