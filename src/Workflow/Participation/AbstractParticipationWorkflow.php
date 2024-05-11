<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Workflow\Participation;

use EsgiIw\TpDesignPattern\Model\Entity\Event;
use EsgiIw\TpDesignPattern\Model\Entity\Participation;
use EsgiIw\TpDesignPattern\Model\Entity\Person;

abstract readonly class AbstractParticipationWorkflow
{
    final public function validateParticipation(Participation $participation): void
    {
        if ($participation->isValidated()) {
            return;
        }

        echo "\n/----- validateEvent() -----";
        $this->validateEvent($participation->getEvent());
        echo "\n\----- validateEvent() -----\n";

        echo "\n/----- validatePerson() -----";
        $this->validatePerson($participation->getPerson());
        echo "\n\----- validatePerson() -----\n";

        echo "\n/----- validateExtraParticipation() -----";
        $this->validateExtraParticipation($participation);
        echo "\n\----- validateExtraParticipation() -----\n";

        echo "\n>> Participation ✅ <<";
        $this->afterValidation($participation);
    }

    protected function validateEvent(Event $event): void
    {
        echo "\n|" . (new \ReflectionClass(self::class))->getShortName();
        echo "\n| - L'événement doit être dans le futur.";
        if ($event->getDate() < new \DateTime('tomorrow')) {
            throw new \UnexpectedValueException('L\'événement est échu.');
        }
    }

    protected function afterValidation(Participation $participation): void
    {
        echo "\n" . (new \ReflectionClass(self::class))->getShortName();
        echo "\n* Participation::validated = true";
        $participation->setValidated(true);
    }

    abstract protected function validatePerson(Person $person): void;

    abstract protected function validateExtraParticipation(Participation $participation): void;
}
