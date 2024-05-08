<?php

declare(strict_types=1);

use EsgiIw\TpDesignPattern\Model\Entity\Event;
use EsgiIw\TpDesignPattern\Model\Repository\EventRepository;

require_once 'vendor/autoload.php';

$eventRepository = new EventRepository(entityClass: Event::class, tableName: 'event');

echo "# Utilisation du EventRepository";

echo "\n\n";

echo "## 1. Récupération de la liste";

echo "\n";
$eventRepository->getList();

echo "\n\n";

$eventDetailId = mt_rand(min: 1, max: 500);
echo "## 2. Récupération du détail de l'événement #{$eventDetailId}";

echo "\n";
$eventRepository->getDetail(id: $eventDetailId);

echo "\n\n";

$eventUpdateId = mt_rand(min: 1, max: 500);
echo "## 3. Mise à jour de la date de l'événement #{$eventUpdateId}";

echo "\n";
$randomDayAdditionner = mt_rand(min: 5, max: 120);
$eventRepository->updateDate(id: $eventUpdateId, newDate: new \DateTime("+ {$randomDayAdditionner} days"));

echo "\n\n";

$eventDeleteId = mt_rand(min: 1, max: 500);
echo "## 3. Suppression de l'événement #{$eventDeleteId}";

echo "\n";
$eventRepository->delete(id: $eventDeleteId);
