<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Workflow\Participation;

use EsgiIw\TpDesignPattern\Model\Entity\Event;
use EsgiIw\TpDesignPattern\Model\Entity\Participation;
use EsgiIw\TpDesignPattern\Model\Entity\Person;
use EsgiIw\TpDesignPattern\Workflow\Participation\Traits\ValidatePersonOnAccountTrait;

final readonly class LimitedSeatParticipationWorkflow extends AbstractParticipationWorkflow
{
    use ValidatePersonOnAccountTrait {
        validatePerson as protected validateAccount;
    }

    protected function validateEvent(Event $event): void
    {
        parent::validateEvent($event);

        echo "\n|" . (new \ReflectionClass(self::class))->getShortName();
        echo "\n| - L'événement définit des places limitées.";
        if (is_int($event->getRemainingSeats()) === false) {
            throw new \UnexpectedValueException('L\'événement n\'a pas de places limitées.');
        }

        echo "\n| - L'événement doit avoir des places disponibles.";
        if ($event->getRemainingSeats() + $event->getRemainingBdeReservedSeats() <= 0) {
            throw new \UnexpectedValueException('L\'événement n\'a aucune place.');
        }
    }

    protected function validatePerson(Person $person): void
    {
        echo "\n|" . (new \ReflectionClass(self::class))->getShortName();
        if ($person->isBdeMember()) {
            echo "\n| - Un membre du BDE doit valider son compte.";
            $this->validateAccount($person);

            return;
        }

        // Pas de validation pour les autres participants
    }

    protected function validateExtraParticipation(Participation $participation): void
    {
        echo "\n|" . (new \ReflectionClass(self::class))->getShortName();
        echo "\n| - Il doit rester des places disponibles.";
        if ($participation->getPerson()->isBdeMember()) {
            echo "\n|    - Un membre du BDE peut utiliser les places réservées.";
            if (
                $participation->getEvent()->getRemainingBdeReservedSeats() <= 0
                && $participation->getEvent()->getRemainingSeats() <= 0
            ) {
                throw new \UnexpectedValueException('L\'événement n\'a plus de place disponible.');
            }
        } else {
            if ($participation->getEvent()->getRemainingSeats() <= 0) {
                throw new \UnexpectedValueException('L\'événement n\'a plus de place disponible.');
            }
        }
    }

    protected function afterValidation(Participation $participation): void
    {
        parent::afterValidation($participation);

        echo "\n" . (new \ReflectionClass(self::class))->getShortName();
        if (
            $participation->getPerson()->isBdeMember()
            && $participation->getEvent()->getRemainingBdeReservedSeats() > 0
        ) {
            echo "\n* Event::remainingBdeReservedSeats - 1";
            $participation
                ->getEvent()
                ->setRemainingBdeReservedSeats($participation->getEvent()->getRemainingBdeReservedSeats() - 1);
        } else {
            echo "\n* Event::remainingSeats - 1";
            $participation
                ->getEvent()
                ->setRemainingSeats($participation->getEvent()->getRemainingSeats() - 1);
        }
    }
}
