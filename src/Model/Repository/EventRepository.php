<?php

declare(strict_types=1);

namespace EsgiIw\TpDesignPattern\Model\Repository;

final readonly class EventRepository
{
    public function __construct(
        private string $entityClass,
        private string $tableName
    ) {
    }

    public function getList(): void
    {
        echo 'Action "' . __FUNCTION__ . "\" pour l'entité \"{$this->entityClass}\" :\n";
        echo <<<SQL
            SELECT id, label, description, date
            FROM {$this->tableName}
            WHERE date > NOW()
            ORDER BY date ASC
            SQL;
    }

    public function getDetail(int $id): void
    {
        echo 'Action "' . __FUNCTION__ . "\" pour l'entité \"{$this->entityClass}\" :\n";
        echo <<<SQL
            SELECT id, label, description, date
            FROM {$this->tableName}
            WHERE id = :id
            SQL;
        echo "\n* Paramètre :id => {$id}";
    }

    public function updateDate(int $id, \DateTime $newDate): void
    {
        echo 'Action "' . __FUNCTION__ . "\" pour l'entité \"{$this->entityClass}\" :\n";
        echo <<<SQL
            UPDATE {$this->tableName}
            SET date = :new_date
            WHERE id = :id
            SQL;
        echo "\n* Paramètre :new_date => '{$newDate->format('Y-m-d H:i:s')}'";
        echo "\n* Paramètre :id => {$id}";
    }

    public function delete(int $id): void
    {
        echo 'Action "' . __FUNCTION__ . "\" pour l'entité \"{$this->entityClass}\" :\n";
        echo <<<SQL
            DELETE
            FROM {$this->tableName}
            WHERE id = :id
            SQL;
        echo "\n* Paramètre :id => {$id}";
    }
}
