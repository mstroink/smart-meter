<?php
declare(strict_types=1);

namespace mstroink\SmartMeter\Reader;

use mstroink\SmartMeter\Reader\Exception\InvalidOutputException;

/**
 * Read Telegram from script
 */
final class Script extends Reader
{
    protected $defaultConfig = [
        'timeout' => 5
    ];

    /**
     * @inheritDoc
     */
    public function output() : string
    {
        $command = sprintf(
            "timeout %d %s -k %d",
            $this->getConfig('timeout'),
            $this->getInput(),
            (int)$this->getConfig('timeout') + 2
        );

        $result = shell_exec($command);

        if (is_null($result)) {
            throw new InvalidOutputException('No results for command (' . $command . ')');
        }

        return $result;
    }
}
