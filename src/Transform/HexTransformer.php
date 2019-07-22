<?php
declare(strict_types=1);

namespace mstroink\SmartMeter\Transform;

/**
 * @inheritDoc
 */
final class HexTransformer implements TransformerInterface
{
    /**
     * @inheritDoc
     */
    public static function transform($string)
    {
        return hex2bin($string);
    }
}
