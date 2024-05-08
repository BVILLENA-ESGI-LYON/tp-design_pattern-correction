<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Notifier;

enum NotifierEnum
{
    case ENTITY_EVENT_UPDATE_BEFORE;
    case ENTITY_EVENT_UPDATE_AFTER;
}
