<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Factory\Alert\Login;

use EsgiIw\TpDesignPattern\Alert\Login\LoginAlertInterface;

abstract class LoginAlertFactory
{
    public function alertForLogin(string $username): void
    {
        $this
            ->getLoginAlert()
            ->handleLoginAlert(username: $username, loginAt: new \DateTime());
    }

    abstract protected function getLoginAlert(): LoginAlertInterface;
}
