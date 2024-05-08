<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Factory\Alert\Login;

use EsgiIw\TpDesignPattern\Alert\Login\LoginAlertInterface;
use EsgiIw\TpDesignPattern\Alert\Login\LoginAlertToAdminEmail;

final class LoginAlertToAdminEmailFactory extends LoginAlertFactory
{
    private ?LoginAlertToAdminEmail $loginAlert = null;

    protected function getLoginAlert(): LoginAlertInterface
    {
        $this->loginAlert ??= new LoginAlertToAdminEmail(
            adminEmail: 'login.bde@esgi.fr'
        );

        return $this->loginAlert;
    }
}
