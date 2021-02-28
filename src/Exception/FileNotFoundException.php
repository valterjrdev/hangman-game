<?php declare(strict_types=1);

namespace App\Exception;

use RuntimeException;

/**
 * @package App\Exception
 */
class FileNotFoundException extends RuntimeException {
    /**
     * @param string $path
     */
    public function __construct($path) {
        parent::__construct(sprintf("Arquivo não encontrado no path: %s", $path));
    }
}