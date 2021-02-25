<?php declare(strict_types=1);

namespace App\Words;

interface WordInterface
{
    public function getValue(): string;
    public function getLength(): int;
}