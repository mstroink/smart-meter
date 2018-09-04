<?php
declare(strict_types=1);

namespace mstroink\SmartMeter\Reader;

use mstroink\SmartMeter\Reader\Exception\InvalidOutputException;
/**
 * Read Telegram from p1
 */
final class P1 extends Reader
{
    protected $_defaultConfig = [
        'baudrate' => '5',
        'bytesize' => 'EIGHTBITS',
        'parity' => 'PARITY_NONE',
        'stopbits' => 'STOPBITS_ONE',
        'xonxoff' => 1,
        'rtscts' => 0,
        'timeout' => 4,
    ];

    public function output(): string
    {
        throw new InvalidOutputException("Not implemented yet");
    }
}
