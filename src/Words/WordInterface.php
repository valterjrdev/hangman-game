<?php

namespace App\Words;

/**
 * @package App\Words
 */
interface WordInterface
{
    /**
     * @return string
     */
    public function getValue(): string;

    /**
     * @return int
     */
    public function getLength(): int;

    /**
     * @param int $index
     *
     * @return string
     */
    public function getLetter(int $index): string;

    /**
     * @return string
     */
    public function getSuggestion(): string;
}
