<?php declare(strict_types=1);

namespace App\Words;

class Word implements WordInterface
{
    private string $value;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
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
}