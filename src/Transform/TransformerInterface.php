<?php
declare(strict_types=1);

namespace mstroink\SmartMeter\Transform;

/**
 * TransormerInterface
 */
interface TransformerInterface
{
    /**
     * Transform telegram (OBIS) value
     * @param mixed $string to transform
     * @return mixed
     */
    public static function transform($string);
}
