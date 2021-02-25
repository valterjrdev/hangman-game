<?php declare(strict_types=1);

namespace App\Exception;

use RuntimeException;

class FileNotFoundException extends \RuntimeException {
    public function __construct($path) {
        parent::__construct(sprintf("Arquivo não encontrado no path: %s", $path));
    }
}