<?php

declare(strict_types=1);

use EsgiIw\TpDesignPattern\Model\Entity\Enum\Event\EventTypeEnum;
use EsgiIw\TpDesignPattern\Model\Entity\Event;
use EsgiIw\TpDesignPattern\Model\Entity\Participation;
use EsgiIw\TpDesignPattern\Model\Entity\Person;
use EsgiIw\TpDesignPattern\Workflow\Participation\LimitedSeatParticipationWorkflow;
use EsgiIw\TpDesignPattern\Workflow\Participation\SportiveEventParticipationWorkflow;

require_once 'vendor/autoload.php';

// Préparation des participations
$participationForSportive = (new Participation())
    ->setEvent(
        (new Event())
            ->setDate(new \DateTime('wednesday next week'))
            ->setType(EventTypeEnum::SPORTIVE)
    )
    ->setPerson(
        (new Person())
            ->setValidatedAccount(true)
    );
$bdeParticipation = (new Participation())
    ->setEvent(
        (new Event())
            ->setDate(new \DateTime('next month'))
            ->setRemainingSeats(0)
            ->setRemainingBdeReservedSeats(3)
    )
    ->setPerson(
        (new Person())
            ->setValidatedAccount(true)
            ->setBdeMember(true)
    );

// Préparation des services de validation
$forSportiveEventParticipationWorkflow = new SportiveEventParticipationWorkflow();
$limitedSeatEventParticipationWorkflow = new LimitedSeatParticipationWorkflow();

echo "# Validation des participations aux événements";

echo "\n\n";

echo "## 1. Événement sportif\n";

$forSportiveEventParticipationWorkflow->validateParticipation($participationForSportive);

echo "\n\n";

echo "## 2. Événement avec places du BDE\n";

$limitedSeatEventParticipationWorkflow->validateParticipation($bdeParticipation);

