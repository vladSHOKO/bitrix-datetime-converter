<?php

declare(strict_types = 1);

namespace Vladshoko\BitrixDateTimeConverter\Converter;

use DateTimeImmutable;
use Exception;
use Vladshoko\BitrixDateTimeConverter\Exception\BitrixUnavailableException;
use Vladshoko\BitrixDateTimeConverter\Validator\BitrixDateTimeAvailableValidator;

class DateTimeConverter
{
    /**
     * @throws BitrixUnavailableException
     */
    public function __construct(
        private readonly BitrixDateTimeAvailableValidator $validator,
    ) {
        if (!$this->validator->validate()) {
            throw new BitrixUnavailableException();
        }
    }

    public function toBitrixDateTime(
        \DateTimeInterface $value,
        string $format = 'Y-m-d H:i:s'
    ): \Bitrix\Main\Type\DateTime {
        $timezone = $value->getTimezone() ? $value->getTimezone() : null;

        return new \Bitrix\Main\Type\DateTime(
            $value->format('Y-m-d H:i:s'),
            $format,
            $timezone
        );
    }

    /**
     * @throws Exception
     */
    public function fromBitrixDateTime(
        \Bitrix\Main\Type\DateTime $value,
        \DateTimeZone $timezone = new \DateTimeZone('Europe/Moscow')
    ): \DateTimeImmutable {
        $timestamp = $value->getTimestamp();

        $dateTimeImmutable = new \DateTimeImmutable(timezone: $timezone);
        return $dateTimeImmutable->setTimestamp($timestamp);
    }
}