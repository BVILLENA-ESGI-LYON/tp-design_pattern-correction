<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Observer\Event;

use EsgiIw\TpDesignPattern\Model\Entity\Event;
use EsgiIw\TpDesignPattern\Notifier\NotifierEnum;
use EsgiIw\TpDesignPattern\Notifier\ObserverInterface;

final class AlertDateUpdateObserver implements ObserverInterface
{
    public function handleNotifier(NotifierEnum $type, mixed $data): void
    {
        if ($data instanceof Event === false || $data->hasChanged('date') === false) {
            return;
        }

        echo "\n> -----";
        echo "\n> " . static::class;
        echo "\n> - Envoi d'un mail aux participants : \n";
        echo <<<MSG
            >     Bonjour,
            >     Nous vous informons que la date de l'événement {$data->getLabel()} a été modifiée.
            >     L'événement a été déplacé pour le {$data->getDate()->format('m/d/Y à H:i')}.
            >     Merci de votre attention.
            MSG;
        echo "\n> -----";
    }
}
