<?php declare(strict_types=1);

namespace App\Words\Datasource;

use App\Words\WordCollection;
use App\Words\WordCollectionInterface;
use App\Words\Word;

class ArrayDatasource implements DatasourceInterface 
{
    private array $words;

    public function __construct(array $words)
    {
        $this->words = $words;
    }
    
     /**
     * @return array
     */
    public function getWords(): array 
    {
        $collection = $this->createCollection(); 
        return $collection->toArray();
    }

    /**
     * @return WordCollectionInterface
     */
    private function createCollection(): WordCollectionInterface
    {
        $collection = new WordCollection();

        foreach ($this->words as $value) {
            $collection->add(new Word($value));
        }

        return $collection;
    }
}