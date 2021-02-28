<?php

namespace App\Words;

/**
 * @package App\Words
 */
class Word implements WordInterface
{
    private string $value;
    private string $suggestion;

    /**
     * @param string $value
     * @param string $suggestion
     */
    public function __construct(string $value, string $suggestion)
    {
        $this->value = $value;
        $this->suggestion = $suggestion;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return strlen(trim($this->value));
    }

    /**
     * @return string
     */
    public function getLetter(int $index): string
    {
        return $this->value[$index];
    }

    /**
     * @return string
     */
    public function getSuggestion(): string
    {
        return $this->suggestion;
    }
}
