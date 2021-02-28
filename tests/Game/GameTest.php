<?php declare(strict_types=1);

namespace App\Tests;

use App\Game\HangmanGame;
use PHPUnit\Framework\TestCase;
use App\Words\WordGenerator;
use App\Words\Datasource\ArrayDatasource;

/**
 * @package App\Tests
 */
final class GameTest extends TestCase
{
    /**
     * @dataProvider providerWin
     * 
     * @param string $row
     * @param array<string> $letters
     * @param string $expected
     * 
     * @return void
     */
    public function testGameWin(string $row, array $letters, string $expected): void
    {
        $object = new WordGenerator(new ArrayDatasource([$row]));
        $word = $object->generate();

        $game = new HangmanGame($word);

        foreach ($letters as $letter) {
            $game->input($letter);
            $this->assertTrue($game->tryAgain());
        }   
        
        $this->assertTrue($game->win());
        $this->assertNotEmpty($game->getAttempts());
        $this->assertEquals($expected, $game->getWordMask());
    }

    /**
     * @dataProvider providerLose
     * 
     * @param string $row
     * @param array<string> $letters
     * @param string $expected
     * 
     * @return void
     */
    public function testGameLose(string $row, array $letters, string $expected): void
    {
        $object = new WordGenerator(new ArrayDatasource([$row]));
        $word = $object->generate();

        $game = new HangmanGame($word);

        foreach ($letters as $letter) {
            $game->input($letter);
        }   
        
        $this->assertFalse($game->win());
        $this->assertEquals($expected, $game->getWordMask());
    }

    /**
     * @return array<string|array>
     */
    public function providerWin(): array
    {
        return array(
          ["animal;cachorro", ["c", "a", "c", "h", "o", "r", "r", "o"], "cachorro"],
          ["animal;gato", ["g", "a", "t", "o"], "gato"]
        );
    }

    /**
     * @return array<string|array>
     */
    public function providerLose(): array
    {
        return array(
          ["animal;cachorro", ["c", "h", "c", "h", "c", "r", "r", "o"], "c_chorr_"],
          ["animal;gato", ["g", "a", "t", "j"], "gat_"]
        );
    }
}