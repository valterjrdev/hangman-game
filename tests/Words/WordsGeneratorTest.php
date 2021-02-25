<?php declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Words\WordGenerator;
use App\Words\Datasource\ArrayDatasource;
use App\Words\Datasource\FileDatasource;
use App\Exception\FileNotFoundException;

final class WordsGeneratorTest extends TestCase
{
    public function testWordGenerateArrayDataSource(): void
    {
        $object = new WordGenerator(new ArrayDatasource(["A", "B"]));
        $word = $object->generate();

        $this->assertInstanceOf("App\Words\WordInterface", $word);
        $this->assertNotEmpty($word->getValue());
        $this->assertNotEmpty($word->getLength());
        $this->assertEquals(1, $word->getLength());
    }

    public function testWordGenerateFileDataSource(): void
    { 
        $file = sprintf("%s/resources/words.txt", dirname(__DIR__));
        $object = new WordGenerator(new FileDatasource($file));
        $word = $object->generate();

        $this->assertInstanceOf("App\Words\WordInterface", $word);
        $this->assertNotEmpty($word->getValue());
        $this->assertNotEmpty($word->getLength());
        $this->assertEquals(1, $word->getLength());
    }

    public function testWordGenerateFileDataSourceFileNotFound(): void
    { 
        $this->expectException(FileNotFoundException::class);
        $object = new WordGenerator(new FileDatasource("/tmp"));
        $object->generate();
    }
}

