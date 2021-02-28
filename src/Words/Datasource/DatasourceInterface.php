<?php declare(strict_types=1);

namespace App\Words\Datasource;

/**
 * @package App\Words\Datasource
 */
interface DatasourceInterface
{
    const CHARACTER_SPLIT_ROW = ';';
    
    /**
     * @return array<string>
     */
    public function getWords(): array;
}