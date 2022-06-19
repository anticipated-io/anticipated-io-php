# PHP SDK for the anticipated.io service

A fast way to add the [anticipated.io](https://anticipated.io) service into your PHP projects.

## Installation

The recommended way to install the <strong>anticipated.io</strong> SDK is through Composer.

```bash
composer require anticipated-io/anticipated-io-php
```

## Usage

```php
    $key = '890asfe08qt43hqtwr980agdsf9y8dfsay234hnb4308'; // API key from https://app.anticipated.io/apiKeys
    $s = new AnticipatedEvents(['key'=>$key]);
    $dateTime = new \DateTime('now', new \DateTimeZone('UTC'));
    $dateTime->modify('+5 min');
    $results = $s->create(
        $dateTime,
        'https://myservice.com/events',
        'POST',
        ''
    );
```

## Tests

Tests executed via PHPUnit. You will need to use composer to install the dev

```shell script
./vendor/bin/phpunit
```
