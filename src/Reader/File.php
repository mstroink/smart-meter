<?php
declare(strict_types=1);

namespace mstroink\SmartMeter\Reader;

use mstroink\SmartMeter\Reader\Exception\InvalidInputException;
use mstroink\SmartMeter\Reader\Exception\InvalidOutputException;

/**
 * Read Telegram from file
 */
final class File extends Reader
{
    /**
     * validates file input
     * @throws InvalidInputException
     * @return void
     */
    private function validateInput(): void
    {
        if (!file_exists($this->getInput())) {
            throw new InvalidInputException("No such file");
        }
    }

    /**
     * @inheritDoc
     * @throws InvalidOutputException if error reading file
     */
    public function output(): string
    {
        $this->validateInput();
        $content = file_get_contents($this->getInput());

        if ($content === false) {
            throw new InvalidOutputException("Error reading input file");
        }

        return $content;
    }
}
