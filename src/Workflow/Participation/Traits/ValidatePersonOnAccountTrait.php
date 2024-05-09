<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Workflow\Participation\Traits;

use EsgiIw\TpDesignPattern\Model\Entity\Person;

trait ValidatePersonOnAccountTrait
{
    protected function validatePerson(Person $person): void
    {
        echo "\n|::ValidatePersonOnAccountTrait";
        echo "\n| - Le compte utilisateur doit être validé.";
        if ($person->isValidatedAccount() === false) {
            throw new \UnexpectedValueException('Le compte utilisateur n\'est pas validé !');
        }
    }
}
