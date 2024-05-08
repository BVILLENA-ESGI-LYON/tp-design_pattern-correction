<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Alert\Login;

final readonly class LoginAlertToLog implements LoginAlertInterface
{
    public function __construct(
        private string $logFilePath
    ) {
    }

    public function handleLoginAlert(string $username, \DateTime $loginAt): void
    {
        echo <<<MSG
                Ajout d'une ligne dans le fichier de log "{$this->logFilePath}" :
                {$this->getLogDateTime($loginAt)} Connexion utilisateur "{$username}".
                MSG;
    }

    protected function getLogDateTime(\DateTime $loginAt): string
    {
        return $loginAt->format('Y-m-d H:i:s');
    }
}
