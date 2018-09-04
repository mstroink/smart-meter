<?php
declare(strict_types=1);

namespace mstroink\SmartMeter\Transform;
/**
 * @inheritDoc
 */
final class TimestampTransformer implements TransformerInterface
{
    /**
     * @inheritDoc
     */
    public function transform($string)
    {
        preg_match("/^(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2}).$/", $string, $match);

        return (new \DateTime(
            sprintf('%d-%d-%d %d:%d:%d', $match[1] + 2000, $match[2], $match[3], $match[4], $match[5], $match[6])
        ))->format('Y-m-d H:i:s');
    }
}
