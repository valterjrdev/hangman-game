<?php declare(strict_types=1);

namespace App\Game;

use App\Words\WordInterface;

/**
 * @package App\Game
 */
class HangmanGame
{
    const FIELD_MASK = "_";

    /**
     * @var WordInterface
     */
    private WordInterface $word;

    /**
     * @var int
     */
    private int $attempts;

    /**
     * @var array<int>
     */
    private array $found;

    /**
     * @var string
     */
    private string $wordMask;

    /**
     * @param WordInterface $word
     */
    public function __construct(WordInterface $word)
    {
        $this->wordMask = str_repeat(self::FIELD_MASK, $word->getLength());
        $this->word = $word;
        $this->found = [];
       
        $this->configureAttempts();
    }

    /**
     * @param string $input
     * 
     * @return void
     */
    public function input(string $input): void
    {  
        $flag = false;

        for ($index = 0; $index < $this->word->getLength(); $index++) {
            $letter = $this->word->getLetter($index);
            
            if (in_array($index, $this->found) || $input != $letter) { 
                continue;
            }

            $flag = true;
            $this->found[] = $index;
            $this->wordMask = substr_replace($this->wordMask, $letter, $index, 1);
            break;
        }

        if (!$flag) {
            $this->attempts = $this->attempts - 1;
        }
    }

    /**
     * @return bool
     */
    public function tryAgain(): bool
    {
        return $this->attempts > 0;
    }

    /**
     * @return bool
     */
    public function win(): bool
    {
        return count($this->found) == $this->word->getLength();
    }

    /**
     * @return int
     */
    public function getAttempts()
    {
        return $this->attempts;
    }

    /**
     * @return string
     */
    public function getWordMask()
    {
        return $this->wordMask;
    }

    /**
     * @return void
     */
    private function configureAttempts(): void
    {
        $this->attempts = rand(3, $this->word->getLength() - 1);
    }   
}