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
    public function transform($string)
    {
        return hex2bin($string);
    }
}
