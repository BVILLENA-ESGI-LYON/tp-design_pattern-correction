<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Alert\Login;

interface LoginAlertInterface
{
    public function handleLoginAlert(string $username, \DateTime $loginAt): void;
}
