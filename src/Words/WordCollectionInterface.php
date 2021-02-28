<?php declare(strict_types=1);

namespace App\Words;

/**
 * @package App\Words
 */
interface WordCollectionInterface
{
    /**
     * @param WordInterface $word
     * 
     * @return WordCollectionInterface
     */
    public function add(WordInterface $word): WordCollectionInterface;
    
    /**
     * @return array<string>
     */
    public function toArray(): array;
}