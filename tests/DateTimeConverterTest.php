<?php

declare(strict_types = 1);

namespace Test\Vladshoko\BitrixDateTimeConverter;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Vladshoko\BitrixDateTimeConverter\Converter\DateTimeConverter;
use Vladshoko\BitrixDateTimeConverter\Validator\BitrixDateTimeAvailableValidator;

class DateTimeConverterTest extends TestCase
{
    private DateTimeConverter $converter;

    public function setUp(): void
    {
        $validator = new BitrixDateTimeAvailableValidator();
        $this->converter = new DateTimeConverter($validator);
    }

    public function test_bitrix_date_time_converting_to_date_time_immutable()
    {
        $bitrixDateTime = new \Bitrix\Main\Type\DateTime(
            date('Y-m-d H:i:s', time())
        );

        $convertedDateTime = $this->converter->fromBitrixDateTime($bitrixDateTime);

        $this->assertSame($bitrixDateTime->getTimestamp(), $convertedDateTime->getTimestamp());
    }

    public function test_bitrix_date_time_converting_to_date_time_immutable_with_correct_timezone()
    {
        $bitrixDateTime = new \Bitrix\Main\Type\DateTime(
            date('Y-m-d H:i:s', time()),
            'Y-m-d H:i:s',
            new \DateTimeZone('UTC')
        );

        $convertedDateTime = $this->converter->fromBitrixDateTime($bitrixDateTime, new \DateTimeZone('UTC'));

        $this->assertSame($bitrixDateTime->getTimestamp(), $convertedDateTime->getTimestamp());
        $this->assertEquals('UTC', $convertedDateTime->getTimezone()->getName());
    }

    public function test_date_time_immutable_converting_to_date_time_immutable_correctly()
    {
        $dateTime = new \DateTimeImmutable('tomorrow', new \DateTimeZone('UTC'));
        $convertedDateTime = $this->converter->toBitrixDateTime($dateTime);

        $this->assertSame($dateTime->getTimestamp(), $convertedDateTime->getTimestamp());
        $this->assertEquals($dateTime->format('Y-m-d H:i:s'), $convertedDateTime->format('Y-m-d H:i:s'));
    }

    public function test_converted_bitrix_date_time_formatting_correctly()
    {
        $dateTime = new \DateTimeImmutable('yesterday', new \DateTimeZone('UTC'));
        $convertedDateTime = $this->converter->toBitrixDateTime($dateTime);

        $this->assertEquals($dateTime->format('Y-m-d H:i:s'), $convertedDateTime->format('Y-m-d H:i:s'));
    }

    public function test_format_converting_to_date_time_immutable()
    {
        $dateTime = new \DateTimeImmutable('now', new \DateTimeZone('UTC'));
        $convertedDateTime = $this->converter->toBitrixDateTime($dateTime, 'd-m-Y-H-i-s');
        $this->assertEquals($dateTime->format('Y-m-d H:i:s'), $convertedDateTime->format('Y-m-d H:i:s'));
        $this->assertEquals($dateTime->format('d-m-Y-H-i-s'), $convertedDateTime->format('d-m-Y-H-i-s'));
    }
}