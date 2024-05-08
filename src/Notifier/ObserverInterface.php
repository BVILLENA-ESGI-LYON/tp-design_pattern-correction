<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Notifier;

interface ObserverInterface
{
    public function handleNotifier(NotifierEnum $type, mixed $data): void;
}
