<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Factory\Alert\Content;

use EsgiIw\TpDesignPattern\Model\Entity\Participation;

interface AlertContentFactory
{
    public function forUserAccountValidation(string $userAccount): string;

    public function forEventParticipationConfirm(Participation $participation): string;

    public function forTomorrowEventReminder(Participation $participation): string;
}
