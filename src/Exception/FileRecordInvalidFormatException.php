<?php declare(strict_types=1);

namespace App\Exception;

use RuntimeException;

/**
 * @package App\Exception
 */
class FileRecordInvalidFormatException extends RuntimeException {
    /**
     * @param string $row
     */
    public function __construct($row) {
        parent::__construct(sprintf("O arquivo contem um registro com formato inválido: %s",$row));
    }
}