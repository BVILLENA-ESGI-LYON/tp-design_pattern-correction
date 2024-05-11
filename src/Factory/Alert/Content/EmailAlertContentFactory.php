<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Factory\Alert\Content;

use EsgiIw\TpDesignPattern\Model\Entity\Participation;

final class EmailAlertContentFactory implements AlertContentFactory
{
    public function forUserAccountValidation(string $userAccount): string
    {
        return "Le compte utilisateur {$userAccount} a été validé le "
            . (new \DateTime())->format('d/m à H:i') . '.';
    }

    public function forEventParticipationConfirm(Participation $participation): string
    {
        return <<<MSG
            Bonjour {$participation->getPerson()->getFirstName()} {$participation->getPerson()->getLastName()},
            
            Vous avez fait une demande le {$participation->getRegistrationAt()->format('d/m/Y')}
            pour participer à l'événement {$participation->getEvent()->getLabel()}
            qui aura lieu le {$participation->getEvent()->getDate()->format('d/m/Y à H:i')}.
            
            Nous vous confirmons votre participation.
            
            Merci et à bientôt.
            MSG;
    }

    public function forTomorrowEventReminder(Participation $participation): string
    {
        return <<<MSG
            Bonjour {$participation->getPerson()->getFirstName()} {$participation->getPerson()->getLastName()},
            
            Vous participez à l'événement {$participation->getEvent()->getLabel()} qui aura lieu demain.
            
            Ne nous oubliez pas !
            
            Bonne journée.
            MSG;
    }
}
