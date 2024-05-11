<?php

declare(strict_types=1);

use EsgiIw\TpDesignPattern\Model\Decorator\Event\EventAsTruncatedStrings;
use EsgiIw\TpDesignPattern\Model\Decorator\Event\EventWithFee;
use EsgiIw\TpDesignPattern\Model\Decorator\Event\EventWithLocation;
use EsgiIw\TpDesignPattern\Model\Entity\Event;

require_once 'vendor/autoload.php';

// Préparation des événements
$eventA = (new Event())
    ->setLabel('Championnat League Of Legends')
    ->setDescription(
        <<<TEXT
           Championnat individuel privé de League of Legends.
           Les équipes seront formées aléatoirement à chaque match.
           Participation financière pour les lots de récompense.
           TEXT
    );
$eventB = (new Event())
    ->setLabel('Soirée escalade')
    ->setDescription('Rendez-vous au MRoc Part-Dieu pour une soirée escalade !');

echo "# Décoration d'événements avec des données / traitements complémentaires";

echo "\n\n";

echo "## 1. Événements \"bruts\"";
echo "\n* {$eventA->getLabel()}";
echo "\n{$eventA->getDescription()}";
echo "\n* {$eventB->getLabel()}";
echo "\n{$eventB->getDescription()}";

echo "\n\n";

echo "## 2. Événements décorés";

echo "\n### 2.1. Avec participation financière";
$eventAWithFee = new EventWithFee(event: $eventA, fee: 10);
echo "\nTitre : « {$eventAWithFee->getLabel()} »";
echo "\nDescription : «";
echo "\n{$eventAWithFee->getDescription()}";
echo "\n»";

echo "\n";

echo "\n### 2.2. Avec textes tronqués (titre : 15 caractères ; description : 30 caractères)";
$eventAAsTruncatedStrings = new EventAsTruncatedStrings(event: $eventA, labelMaxLength: 15, descriptionMaxLength: 30);
echo "\nTitre : « {$eventAAsTruncatedStrings->getLabel()} »";
echo "\nDescription : «";
echo "\n{$eventAAsTruncatedStrings->getDescription()}";
echo "\n»";

echo "\n";

echo "\n### 2.3. Avec localisation";
$eventBWithLocation = new EventWithLocation(
    event: $eventB,
    address: '86, rue du Pensionnat',
    postalCode: '69003',
    city: 'Lyon'
);
echo "\nTitre : « {$eventBWithLocation->getLabel()} »";
echo "\nDescription : «";
echo "\n{$eventBWithLocation->getDescription()}";
echo "\n»";

echo "\n\n";

echo "## 3. Décorators imbriqués";
echo "\n### 3.1. Localisation + participation financière";
$eventBWithLocationAndFee = new EventWithFee(event: $eventBWithLocation, fee: 5);
echo "\nTitre : « {$eventBWithLocationAndFee->getLabel()} »";
echo "\nDescription : «";
echo "\n{$eventBWithLocationAndFee->getDescription()}";
echo "\n»";

echo "\n";

echo "\n### 3.1. Localisation + participation financière + textes tronqués (titre : 20 caractères ; description : 80 caractères)";
$eventBWithLocationAndFeeAsTruncatedStrings = new EventAsTruncatedStrings(
    event: $eventBWithLocationAndFee,
    labelMaxLength: 20,
    descriptionMaxLength: 80
);
echo "\nTitre : « {$eventBWithLocationAndFeeAsTruncatedStrings->getLabel()} »";
echo "\nDescription : «";
echo "\n{$eventBWithLocationAndFeeAsTruncatedStrings->getDescription()}";
echo "\n»";
