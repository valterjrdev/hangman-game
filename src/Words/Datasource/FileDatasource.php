<?php declare(strict_types=1);

namespace App\Words\Datasource;

use App\Words\WordCollection;
use App\Words\WordCollectionInterface;
use App\Words\Word;
use App\Exception\FileNotFoundException;

class FileDatasource implements DatasourceInterface 
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
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
        $words = $this->load();

        $collection = new WordCollection();
  
        foreach ($words as $value) {
            $collection->add(new Word($value));
        }

        return $collection;
    }

    private function load()
    {
        if (is_dir($this->path) || !file_exists($this->path)) {
            throw new FileNotFoundException($this->path);
        }

        return new \SplFileObject($this->path, 'r');
    }
}