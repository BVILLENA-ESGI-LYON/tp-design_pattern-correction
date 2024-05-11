<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Factory\Alert\Login;

use EsgiIw\TpDesignPattern\Alert\Login\LoginAlertInterface;
use EsgiIw\TpDesignPattern\Alert\Login\LoginAlertToDatabase;

final class LoginAlertToDatabaseFactory extends LoginAlertFactory
{
    private ?LoginAlertToDatabase $loginAlert = null;

    protected function getLoginAlert(): LoginAlertInterface
    {
        $this->loginAlert ??= new LoginAlertToDatabase();

        return $this->loginAlert;
    }
}
