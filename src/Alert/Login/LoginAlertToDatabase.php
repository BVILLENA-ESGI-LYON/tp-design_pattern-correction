<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Alert\Login;

final readonly class LoginAlertToDatabase implements LoginAlertInterface
{
    public function handleLoginAlert(string $username, \DateTime $loginAt): void
    {
        echo <<<MSG
                Création enregistrement dans la table "log_login" :\n
                MSG;
        echo <<<SQL
                INSERT INTO log_login (username, loginAt)
                VALUES
                (
                     '{$username}'
                    ,'{$this->getSqlDateTime($loginAt)}'
                )
                SQL;
    }

    private function getSqlDateTime(\DateTime $loginAt): string
    {
        return $loginAt->format('Y-m-d H:i:s');
    }
}
