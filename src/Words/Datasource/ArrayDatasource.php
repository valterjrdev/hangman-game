<?php declare(strict_types=1);

namespace App\Words\Datasource;

use App\Words\WordCollection;
use App\Words\WordCollectionInterface;
use App\Words\Word;
use App\Exception\FileRecordInvalidFormatException;

/**
 * @package App\Words\Datasource
 */
class ArrayDatasource implements DatasourceInterface 
{
    /**
     * @var array<string>
     */
    private array $words;

    /**
     * @param array<string> $words
     */
    public function __construct(array $words)
    {
        $this->words = $words;
    }
    
     /**
     * @return array<string>
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
            if (!str_contains($value, DatasourceInterface::CHARACTER_SPLIT_ROW)) {
                throw new FileRecordInvalidFormatException($value);
            }

            $split = explode(";", $value);
            $collection->add(new Word($split[1], $split[0]));
        }

        return $collection;
    }
}