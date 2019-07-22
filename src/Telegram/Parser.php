<?php
declare(strict_types = 1);

namespace mstroink\SmartMeter\Telegram;

use mstroink\SmartMeter\Telegram\Exception\InvalidTelegramException;
use mstroink\SmartMeter\Telegram\Obis\ReferencesInterface;
use mstroink\SmartMeter\Transform\TransformerInterface;

/**
 * Telegram Parser Class
 */
class Parser
{
    /**
     * @var ReferencesInterface
     */
    protected $Mapper;

    /**
     * @param ReferencesInterface $mapper
     */
    public function __construct(ReferencesInterface $mapper)
    {
        $this->Mapper = $mapper;
    }

    /**
     * Converts telegram data into an array "line by line"
     * @param string $telegram raw telegram data
     * @param bool $verify crc checksum
     * @return array returns telegram data as an array
     */
    public function parse(string $telegram, bool $verify = true): array
    {
        if ($verify) {
            $this->verify($telegram);
        }

        $data = [];
        foreach (explode(ReferencesInterface::LINE_SEPERATOR, $telegram) as $line) {
            $id = $this->extractId($line);
            if (!$id) {
                continue;
            }

            $reference = $this->getReference($id);
            if (!$reference) {
                continue;
            }

            $values = $this->extractValues($line);
            $transformers = (array)$reference['transform'];

            $parsedValues = $this->parseValues($values, $transformers);

            $data[$reference['key']] = (count($parsedValues) == 1) ? $parsedValues[0] : $parsedValues;
        }

        return $data;
    }

    /**
     * Extract values from telegram line
     * @param  string $line telegram line
     * @return array matched values
     */
    protected function extractValues(string $line): array
    {
        preg_match_all("/((?<=\()[0-9a-zA-Z\.\*]{0,}(?=\)))+/", $line, $match);

        return $match[1];
    }

    /**
     * Parse values extracted from the telegram line
     * @param array $values extracted from telegram line
     * @param array $transformers used to transform the values
     * @return array array transformed values
     */
    protected function parseValues(array $values, array $transformers): array
    {
        $data = [];
        for ($i = 0; $i < count($values); $i++) {
            $value = $values[$i];
            $transformer = $transformers[$i] ?? false;

            if (!$transformer) {
                break;
            }
            
            $data[] = ($value !== "") ? $this->transform($value, $transformer) : null;
        }

        return $data;
    }

    /**
     * Extract reference id from telegram line
     * @param string $line telegram line
     * @return string|bool string or false if not found
     */
    protected function extractId(string $line)
    {
        return strstr($line, '(', true);
    }

    /**
     * Transforms telegram data
     * @param string $string data to transform into new type
     * @param string $transformer object to use
     * @return mixed data the transformer object returns
     */
    protected function transform(string $string, string $transformer)
    {
        if (strpos($transformer, '\\') === false) {
            $transformer = '\mstroink\SmartMeter\Transform\\' . ucfirst($transformer) . 'Transformer';
        }

        if (!is_subclass_of($transformer, TransformerInterface::class)) {
            throw new \RuntimeException("Transformer must implement TransformerInterface.");
        }

        return call_user_func($transformer . '::transform', $string);
    }

    /**
     * Get template for parsing the telegram data
     * @param string $id Reference id/index
     * @return array|null telegram fields with regex pattern and description;
     * null if not found
     */
    protected function getReference(string $id): ?array
    {
        return $this->Mapper->getReference($id);
    }

    /**
     * Verify Telegram checksum
     * @param  string $data raw telegram data
     * @throws \mstroink\SmartMeter\Telegram\Exception\InvalidTelegramException
     * @return void
     */
    private function verify(string $data): void
    {
        preg_match("/^([^!]+!)([A-Z0-9]{4})/", $data, $match);
        if (!isset($match[2])) {
            throw new InvalidTelegramException('Content or CRC data not found');
        }

        list(, $content, $crc) = $match;
        $crc = hexdec('0x' . $crc);
        $calculatedChecksum = $this->crc16($content);

        if ($crc !== $calculatedChecksum) {
            throw new InvalidTelegramException('CRC mismatch: Content ' . $calculatedChecksum . ' CRC ' . $crc);
        }
    }

    /**
     * Calculates the crc16 of a string
     * @param string $string the data
     * @return int the crc16 checksum of string as an integer.
     */
    private function crc16(string $string): int
    {
        $crc = 0;
        for ($x = 0; $x < strlen($string); $x++) {
            $crc = $crc ^ ord($string[$x]);
            for ($y = 0; $y < 8; $y++) {
                if (($crc & 0x0001) == 0x0001) {
                    $crc = ($crc >> 1) ^ 0xA001;
                } else {
                    $crc = $crc >> 1;
                }
            }
        }

        return $crc;
    }
}
