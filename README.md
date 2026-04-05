## bitrix-datetime-converter

DateTime conversion utilities for Bitrix environment

## Requirements

- PHP ^8.2
- Bitrix runtime for production usage (`\Bitrix\Main\Type\DateTime` must be available)

## Installation

```bash
composer require vladshoko/bitrix-datetime-converter
```

## Quick start

### Convert `DateTimeInterface` to Bitrix `DateTime`
```php
$converter = new \Vladshoko\BitrixDateTimeConverter\Converter\DateTimeConverter();
$source = new \DateTimeImmutable('now', new \DateTimeZone('UTC'));

$bitrixDateTime = $converter->toBitrixDateTime($source);
```

### Convert Bitrix `DateTime` to `DateTimeImmutable`
```php
$converted = $converter->fromBitrixDateTime(
    $bitrixDateTime,
    new \DateTimeZone('UTC')
);
```

## Testing
```bash
composer test:with-stub
composer test:no-stub
composer test
```
