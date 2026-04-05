<?php

declare(strict_types=1);

namespace Bitrix\Main\Type;

use DateTimeImmutable;
use DateTimeZone;
use RuntimeException;

final class DateTime
{
    private DateTimeImmutable $inner;

    public function __construct(
        string $value = '1970-01-01 00:00:00',
        string $format = 'Y-m-d H:i:s',
        DateTimeZone|false|null $timezone = null
    ) {
        $tz = $timezone instanceof DateTimeZone ? $timezone : new DateTimeZone('UTC');

        $parsed = DateTimeImmutable::createFromFormat($format, $value, $tz);
        if ($parsed === false) {
            throw new RuntimeException(sprintf(
                'Stub Bitrix DateTime parse failed. value="%s", format="%s", tz="%s"',
                $value,
                $format,
                $tz->getName()
            ));
        }

        $this->inner = $parsed;
    }

    public function getTimestamp(): int
    {
        return $this->inner->getTimestamp();
    }

    public function format(string $format): string
    {
        return $this->inner->format($format);
    }
}