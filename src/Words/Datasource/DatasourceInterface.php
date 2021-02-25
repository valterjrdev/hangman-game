<?php declare(strict_types=1);

namespace App\Words\Datasource;

interface DatasourceInterface
{
    /**
     * @return array
     */
    public function getWords(): array;
}