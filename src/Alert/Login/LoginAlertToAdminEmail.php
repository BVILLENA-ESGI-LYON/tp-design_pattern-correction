<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Alert\Login;

final readonly class LoginAlertToAdminEmail implements LoginAlertInterface
{
    public function __construct(
        private string $adminEmail
    ) {
    }

    public function handleLoginAlert(string $username, \DateTime $loginAt): void
    {
        echo "Envoi d'un mail à {$this->adminEmail}\n";
        echo <<<MSG
                Sujet : Connexion utilisateur
                Contenu : L'utilisateur "{$username}" s'est connecté·e le {$this->getDateTimeFormat($loginAt)}.
                MSG;
    }

    private function getDateTimeFormat(\DateTime $loginAt): string
    {
        return $loginAt->format('d/m/Y à H:i:s');
    }
}
