<?php declare(strict_types=1);

namespace App\Words;

use App\Words\Datasource\DatasourceInterface;

class WordGenerator 
{
    private DatasourceInterface $datasource;

    public function __construct(DatasourceInterface $datasource)
    {
        $this->datasource = $datasource;
    }

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