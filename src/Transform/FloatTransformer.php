<?php
declare(strict_types=1);

namespace mstroink\SmartMeter\Transform;

/**
 * @inheritDoc
 */
final class FloatTransformer implements TransformerInterface
{
    /**
     * @inheritDoc
     */
    public static function transform($string)
    {
        return (float)$string;
    }
}
