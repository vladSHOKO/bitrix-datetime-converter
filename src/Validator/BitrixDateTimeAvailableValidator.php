<?php

declare(strict_types = 1);

namespace Vladshoko\BitrixDateTimeConverter\Validator;

class BitrixDateTimeAvailableValidator
{
    public function validate(): bool
    {
        return class_exists('Bitrix\\Main\\Type\\DateTime');
    }
}