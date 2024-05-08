<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Factory\Alert\Login;

use EsgiIw\TpDesignPattern\Alert\Login\LoginAlertInterface;
use EsgiIw\TpDesignPattern\Alert\Login\LoginAlertToLog;

final class LoginAlertToLogFactory extends LoginAlertFactory
{
    private ?LoginAlertToLog $loginAlert = null;

    protected function getLoginAlert(): LoginAlertInterface
    {
        $this->loginAlert ??= new LoginAlertToLog(
            logFilePath: sys_get_temp_dir() . '/design-patterns/var/log/login.log'
        );

        return $this->loginAlert;
    }
}
