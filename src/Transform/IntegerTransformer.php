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
    public function transform($string)
    {
    	return (int)$string;
    }
}
