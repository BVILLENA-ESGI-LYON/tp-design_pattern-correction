<?php

declare(strict_types=1);

use EsgiIw\TpDesignPattern\Factory\Alert\Content\EmailAlertContentFactory;
use EsgiIw\TpDesignPattern\Factory\Alert\Content\SmsAlertContentFactory;
use EsgiIw\TpDesignPattern\Model\Entity\Event;
use EsgiIw\TpDesignPattern\Model\Entity\Participation;
use EsgiIw\TpDesignPattern\Model\Entity\Person;

require_once 'vendor/autoload.php';

// Mise en place des diverses entités et variables
$validatedUserAccount = uniqid() . '@gmail.fr';

$validatedParticipation = (new Participation())
    ->setPerson(
        (new Person())
            ->setFirstName('Paul')
            ->setLastName('Ochon')
    )
    ->setEvent(
        (new Event())
            ->setLabel('Soirée pyjama')
            ->setDate((new \DateTime('+1 month +4 days'))->setTime(hour: 20, minute: 0))
    )
    ->setRegistrationAt(new \DateTime());

$participationForTomorrowEvent = (new Participation())
    ->setPerson(
        (new Person())
            ->setFirstName('Marc')
            ->setLastName('Dépoin')
    )
    ->setEvent(
        (new Event())
            ->setLabel('Championnat RocketLeague')
            ->setDate((new \DateTime('tomorrow'))->setTime(hour: 14, minute: 0))
    )
    ->setRegistrationAt(new \DateTime('-2 months -8 days'));

// Instantiation des implémentations Abstract factory
$emailAlertContentFactory = new EmailAlertContentFactory();
$smsAlertContentFactory = new SmsAlertContentFactory();

echo "# Récupération du contenu des diverses alertes\n";
echo "----------------------------------------------\n";

echo "\n";

echo "## 1. Validation du compte utilisateur {$validatedUserAccount}";

echo "\n\n";

echo "* Alerte par SMS :\n";
echo $smsAlertContentFactory->forUserAccountValidation($validatedUserAccount);

echo "\n\n";

echo "* Alerte par mail :\n";
echo $emailAlertContentFactory->forUserAccountValidation($validatedUserAccount);

echo "\n\n";

echo "## 2. Validation participation";

echo "\n\n";

echo "* Alerte par SMS :\n";
echo $smsAlertContentFactory->forEventParticipationConfirm($validatedParticipation);

echo "\n\n";

echo "* Alerte par mail :\n";
echo $emailAlertContentFactory->forEventParticipationConfirm($validatedParticipation);

echo "\n\n";

echo "## 3. Rappel de participation";

echo "\n\n";

echo "* Alerte par SMS :\n";
echo $smsAlertContentFactory->forTomorrowEventReminder($participationForTomorrowEvent);

echo "\n\n";

echo "* Alerte par mail :\n";
echo $emailAlertContentFactory->forTomorrowEventReminder($participationForTomorrowEvent);
