<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Factory\Alert\Content;

use EsgiIw\TpDesignPattern\Model\Entity\Participation;

final class SmsAlertContentFactory implements AlertContentFactory
{
    public function forUserAccountValidation(string $userAccount): string
    {
        return "Validation compte utilisateur « {$userAccount} ».";
    }

    public function forEventParticipationConfirm(Participation $participation): string
    {
        return "Votre participation à l'événement {$participation->getEvent()->getLabel()} est validée.";
    }

    public function forTomorrowEventReminder(Participation $participation): string
    {
        return "N'oubliez pas l'événement {$participation->getEvent()->getLabel()} de demain.";
    }
}
