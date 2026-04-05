<?php

declare(strict_types = 1);

namespace Test\Vladshoko\BitrixDateTimeAvailableValidator;

use PHPUnit\Framework\TestCase;
use Vladshoko\BitrixDateTimeConverter\Converter\DateTimeConverter;
use Vladshoko\BitrixDateTimeConverter\Exception\BitrixUnavailableException;
use Vladshoko\BitrixDateTimeConverter\Validator\BitrixDateTimeAvailableValidator;

class BitrixDateTimeAvailableValidatorTest extends TestCase
{
    public function test_validation_throws_exception()
    {
        $this->expectException(BitrixUnavailableException::class);
        $validator = new BitrixDateTimeAvailableValidator();
        $converter = new DateTimeConverter($validator);
    }
}