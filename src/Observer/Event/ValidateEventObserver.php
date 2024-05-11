<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Observer\Event;

use EsgiIw\TpDesignPattern\Model\Entity\Event;
use EsgiIw\TpDesignPattern\Notifier\NotifierEnum;
use EsgiIw\TpDesignPattern\Notifier\ObserverInterface;

final class ValidateEventObserver implements ObserverInterface
{
    public function handleNotifier(NotifierEnum $type, mixed $data): void
    {
        if ($data instanceof Event === false) {
            return;
        }

        echo "\n> -----";
        echo "\n> " . static::class;
        if ($data->hasChanged(propertyName: 'label')) {
            echo "\n> - Event::label => NotBlank ; Length(max: 50)";
            $this->assertEventLabel($data);
        }
        if ($data->hasChanged(propertyName: 'description')) {
            echo "\n> - Event::description => Length(max: 500)";
            $this->assertEventDescription($data);
        }
        if ($data->hasChanged(propertyName: 'date')) {
            echo "\n> - Event::date => GreaterThan(value: today)";
            $this->assertEventDate($data);
        }
        echo "\n> -----";
    }

    private function assertEventLabel(Event $event): void
    {
        if (trim($event->getLabel()) === '') {
            throw new \UnexpectedValueException('Le titre de l\'événement est obligatoire.');
        }
        if (mb_strlen($event->getLabel()) > 50) {
            throw new \UnexpectedValueException('Le titre de l\'événement ne doit pas excéder 50 caractères.');
        }
    }

    private function assertEventDescription(Event $event): void
    {
        if (mb_strlen($event->getDescription()) > 500) {
            throw new \UnexpectedValueException('La description de l\'événement ne doit pas excéder 500 caractères.');
        }
    }

    private function assertEventDate(Event $event): void
    {
        if ($event->getDate() <= new \DateTime('tomorrow')) {
            throw new \UnexpectedValueException('La date de l\'événement ne doit pas être antérieure à demain.');
        }
    }
}
