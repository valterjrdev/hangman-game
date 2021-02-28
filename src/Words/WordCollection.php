<?php declare(strict_types=1);

namespace App\Words;

/**
 * @package App\Words
 */
class WordCollection extends \ArrayObject implements WordCollectionInterface
{
    /**
     * @return WordCollection<WordInterface>
     */
    public function add(WordInterface $word): WordCollectionInterface
    {
        parent::append($word);
        return $this;
    }

    /**
     * @return array<string>
     */
    public function toArray(): array
    {
        return $this->getArrayCopy();
    }
}
