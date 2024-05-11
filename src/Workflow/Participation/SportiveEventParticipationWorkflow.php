<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Workflow\Participation;

use EsgiIw\TpDesignPattern\Model\Entity\Enum\Event\EventTypeEnum;
use EsgiIw\TpDesignPattern\Model\Entity\Event;
use EsgiIw\TpDesignPattern\Model\Entity\Participation;
use EsgiIw\TpDesignPattern\Workflow\Participation\Traits\ValidatePersonOnAccountTrait;

final readonly class SportiveEventParticipationWorkflow extends AbstractParticipationWorkflow
{
    use ValidatePersonOnAccountTrait;

    protected function validateEvent(Event $event): void
    {
        echo "\n|" . (new \ReflectionClass(self::class))->getShortName();
        echo "\n| - L'événement doit être de type « Sportif ».";
        if ($event->getType() !== EventTypeEnum::SPORTIVE) {
            throw new \UnexpectedValueException('L\'événement n\'est pas de type « Sportif » !');
        }

        parent::validateEvent($event);
    }

    protected function validateExtraParticipation(Participation $participation): void
    {
        echo "\n|" . (new \ReflectionClass(self::class))->getShortName();
        echo "\n| - Un certificat médical doit avoir été déposé.";
//        if ($this->documentChecker->hasMedicalCertificate($participation) === false) {
//            throw new \UnexpectedValueException('Aucun certificat médical déposé !');
//        }
    }
}
