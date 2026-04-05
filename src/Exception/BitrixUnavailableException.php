<?php

declare(strict_types = 1);

namespace Vladshoko\BitrixDateTimeConverter\Exception;

class BitrixUnavailableException extends \Exception
{
    protected $message = 'Bitrix classes are not available.';

    protected $code = 500;
}