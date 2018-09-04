<?php
declare(strict_types=1);

namespace mstroink\SmartMeter\Transform;
/**
 * TransormerInterface
 */
Interface TransformerInterface
{
    /**
     * Transform telegram (OBIS) value
     * @param mixed $string to transform
     * @return mixed
     */
    public function transform($string);
}
