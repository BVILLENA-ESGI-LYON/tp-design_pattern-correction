<?php

declare(strict_types=1);

use EsgiIw\TpDesignPattern\Model\Entity\Event;
use EsgiIw\TpDesignPattern\Model\EntityPersister\EventEntityPersister;
use EsgiIw\TpDesignPattern\Notifier\NotifierEnum;
use EsgiIw\TpDesignPattern\Notifier\ObserverRegistry;
use EsgiIw\TpDesignPattern\Notifier\Publisher;
use EsgiIw\TpDesignPattern\Observer\Event\AlertDateUpdateObserver;
use EsgiIw\TpDesignPattern\Observer\Event\ResetChangeSetObserver;
use EsgiIw\TpDesignPattern\Observer\Event\ValidateEventObserver;

require_once 'vendor/autoload.php';

// Préparation entité
$event = (new Event())
    ->setId(mt_rand(min: 1, max: 500))
    ->setLabel('Afterwork')
    ->setDescription('Afterwork mensuel de fin du mois.')
    ->setDate((new \DateTime('last friday of this month'))->setTime(hour: 18, minute: 0));
$event->resetChangeSet();

// Préparation Observers + Publisher + Persister
$observerRegistry = (new ObserverRegistry())
    ->addObserver(
        notifier: NotifierEnum::ENTITY_EVENT_UPDATE_BEFORE,
        observer: new ValidateEventObserver()
    )
    ->addObserver(
        notifier: NotifierEnum::ENTITY_EVENT_UPDATE_AFTER,
        observer: new AlertDateUpdateObserver()
    )
    ->addObserver(
        notifier: NotifierEnum::ENTITY_EVENT_UPDATE_AFTER,
        observer: new ResetChangeSetObserver()
    );

$publisher = new Publisher($observerRegistry);

$eventEntityPersister = new EventEntityPersister($publisher);

echo "# Modifications avec observables\n\n";

echo "## 1. Modification Titre";
$event->setLabel('Afterwork + Blind test');

echo "\n";
$eventEntityPersister->updateEvent(event: $event);

echo "\n\n";

echo "## 2. Modification date + description";
$event
    ->setDate((new \DateTime('first wednesday of next month'))->setTime(hour: 18, minute: 30))
    ->setDescription('Afterwork avec blind tests.');

echo "\n";
$eventEntityPersister->updateEvent(event: $event);
