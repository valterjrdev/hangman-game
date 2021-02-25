<?php declare(strict_types=1);

namespace App\Words;

class WordCollection extends \ArrayObject implements WordCollectionInterface
{
    /**
     * @return WordCollection
     */
    public function add(WordInterface $word): WordCollectionInterface
    {
        parent::append($word);
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->getArrayCopy();
    }
}
