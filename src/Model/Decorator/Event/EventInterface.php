<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Model\Decorator\Event;

interface EventInterface
{
    public function getLabel(): string;

    public function getDescription(): string;

    public function getDate(): \DateTime;
}
