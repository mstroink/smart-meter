<?php
declare(strict_types=1);

namespace mstroink\SmartMeter;

use mstroink\SmartMeter\Reader\Reader;
use mstroink\SmartMeter\Telegram\Obis\Mapper;
use mstroink\SmartMeter\Telegram\Parser;

/**
 * Base class for the Telegram Parser
 */
class SmartMeter
{
    /**
     * @var Reader
     */
    protected $reader;
    /**
     * @var Parser
     */
    protected $parser;

    /**
     * Constructor
     * @param Reader $reader
     * @param Parser $parser
     */
    public function __construct(Reader $reader, Parser $parser)
    {
        $this->reader = $reader;
        $this->parser = $parser;
    }

    /**
     * Read a telegeram
     * @return array telegram data
     */
    public function read(): array
    {
        $raw = $this->reader->output();

        return $this->parser->parse($raw, true);
    }

    /**
     * Configure this class
     * @param string $reader name of the reader
     * @param array $config of the reader
     * @return SmartMeter
     */
    public static function configure($reader, $config): SmartMeter
    {
        $input = $config['input'] ?? null;
        if (!$input) {
            new \InvalidArgumentException('Please set input path in config');
        }

        $reader = self::createReader($reader, $input, $config);
        $parser = self::createParser();

        return new self($reader, $parser);
    }

    /**
    * Create reader object
    * @param string $name of the reader
    * @param string $input to read from
    * @param array $config reader config
    * @return Reader
    */
    private static function createReader(string $name, string $input, array $config): Reader
    {
        $class = "\mstroink\SmartMeter\Reader\\" . ucfirst($name);

        if (!class_exists($class)) {
            throw new \RuntimeException($class . ' does not exists');
        }

        return new $class($input, $config);
    }

    /**
     * Create Parser Object
     * @return Parser
     */
    private static function createParser(): Parser
    {
        return new Parser(new Mapper());
    }
}
