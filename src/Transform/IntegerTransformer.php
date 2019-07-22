<?php
declare(strict_types=1);

namespace mstroink\SmartMeter\Transform;

/**
 * @inheritDoc
 */
final class IntegerTransformer implements TransformerInterface
{
    /**
     * @inheritDoc
     */
    public static function transform($string)
    {
        return (int)$string;
    }
}
