<?php declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Words\WordGenerator;
use App\Words\Datasource\ArrayDatasource;
use App\Words\Datasource\FileDatasource;
use App\Exception\FileNotFoundException;
use App\Exception\FileRecordInvalidFormatException;

/**
 * @package App\Tests
 */
final class WordsGeneratorTest extends TestCase
{
    /**
     * @return void
     */
    public function testWordGenerateArrayDataSource(): void
    {
        $object = new WordGenerator(new ArrayDatasource(["animal;A", "animal;B"]));
        $word = $object->generate();

        $this->assertInstanceOf("App\Words\WordInterface", $word);
        $this->assertNotEmpty($word->getValue());
        $this->assertNotEmpty($word->getLength());
        $this->assertEquals(1, $word->getLength());
        $this->assertEquals("animal", $word->getSuggestion());
    }

    /**
     * @return void
     */
    public function testWordGenerateFileDataSource(): void
    { 
        $file = sprintf("%s/resources/words.txt", dirname(__DIR__));
        $object = new WordGenerator(new FileDatasource($file));
        $word = $object->generate();

        $this->assertInstanceOf("App\Words\WordInterface", $word);
        $this->assertNotEmpty($word->getValue());
        $this->assertNotEmpty($word->getLength());
        $this->assertEquals("animal", $word->getSuggestion());
    }

    /**
     * @return void
     */
    public function testWordGenerateFileDataSourceFileNotFound(): void
    { 
        $this->expectException(FileNotFoundException::class);
        $object = new WordGenerator(new FileDatasource("/tmp"));
        $object->generate();
    }

    /**
     * @return void
     */
    public function testWordGenerateArrayDataSourceRecordInvalidFormat(): void
    { 
        $this->expectException(FileRecordInvalidFormatException::class);
        $object = new WordGenerator(new ArrayDatasource(["animalA"]));
        $object->generate();
    }

    /**
     * @return void
     */
    public function testWordGenerateFileDataSourceRecordInvalidFormat(): void
    { 
        $this->expectException(FileRecordInvalidFormatException::class);
        $file = sprintf("%s/resources/words_invalid.txt", dirname(__DIR__));
        $object = new WordGenerator(new FileDatasource($file));
        $object->generate();
    }

    /**
     * @return void
     */
    public function testWordGetLetter(): void
    {
        $object = new WordGenerator(new ArrayDatasource(["animal;A"]));
        $word = $object->generate();
        $this->assertEquals("A", $word->getLetter(0));
    }
}

