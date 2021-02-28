<?php

namespace App\Words\Datasource;

use App\Words\WordCollection;
use App\Words\WordCollectionInterface;
use App\Words\Word;
use App\Exception\FileNotFoundException;
use App\Exception\FileRecordInvalidFormatException;

/**
 * @package App\Words\Datasource
 */
class FileDatasource implements DatasourceInterface
{
    /**
     * @var string
     */
    private string $path;

    /**
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
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
        $words = $this->load();

        $collection = new WordCollection();

        /**
         * @var string $value
         */
        foreach ($words as $value) {
            if (!str_contains($value, DatasourceInterface::CHARACTER_SPLIT_ROW)) {
                throw new FileRecordInvalidFormatException($value);
            }

            $split = explode(";", $value);
            $collection->add(new Word($split[1], $split[0]));
        }

        return $collection;
    }

    /**
     * @return \SplFileObject
     */
    private function load(): \SplFileObject
    {
        if (is_dir($this->path) || !file_exists($this->path)) {
            throw new FileNotFoundException($this->path);
        }

        return new \SplFileObject($this->path, 'r');
    }
}
