<?php

namespace App\Words\Datasource;

/**
 * @package App\Words\Datasource
 */
interface DatasourceInterface
{
    public const CHARACTER_SPLIT_ROW = ';';

    /**
     * @return array<string>
     */
    public function getWords(): array;
}
