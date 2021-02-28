<?php

namespace App\Words;

use App\Words\Datasource\DatasourceInterface;

/**
 * @package App\Words
 */
class WordGenerator
{
    /**
     * @var DatasourceInterface
     */
    private DatasourceInterface $datasource;

    /**
     * @param DatasourceInterface $datasource
     */
    public function __construct(DatasourceInterface $datasource)
    {
        $this->datasource = $datasource;
    }

    /**
     * @return WordInterface
     */
    public function generate(): WordInterface
    {
        $words = $this->datasource->getWords();
        /**
         * @var WordInterface $word
         */
        $word = $words[array_rand($words)];

        return $word;
    }
}
