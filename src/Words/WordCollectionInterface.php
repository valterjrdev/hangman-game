<?php declare(strict_types=1);

namespace App\Words;

interface WordCollectionInterface
{
    public function add(WordInterface $word): WordCollectionInterface;
    public function toArray(): array;
}