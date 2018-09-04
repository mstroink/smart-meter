<?php
declare(strict_types=1);

namespace mstroink\SmartMeter\Reader;
/**
 * Abstract Reader
 */
abstract class Reader
{
    /**
     * Input to read from
     * @var string $input
     */
    private $input;
    /**
     * defaultConfig
     * @var array $defaultConfig
     */
    protected $defaultConfig = [];
    /**
     * Runtime config
     * @var array $config
     */
    protected $config;

    /**
     * Constructor
     * @param string $input to read from
     * @param array $config read config
     */
    public function __construct(string $input, $config = [])
    {
        $this->config = array_merge($this->defaultConfig, $config);
        $this->input = $input;
    }

    /**
     * getInput
     * @return string
     */
    protected function getInput(): string
    {
        return $this->input;
    }

    /**
     * GetConfig by Key
     * @param  string $key
     * @return mixed
     */
    protected function getConfig(string $key)
    {
        return $this->config[$key] ?? null;
    }

    /**
     * Output of reader
     * @return string
     */
    abstract public function output(): string;
}
