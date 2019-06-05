Klaviyo HttpClient
=================

This PHP library provide a simple way to send events to Klaviyo API.
This implementation is based on an asynch [HttpClient](https://github.com/Rxnet/http-client)
that use [Reactive Programming](https://github.com/ReactiveX/RxPHP) paradigm.

[![Latest Stable Version](https://poser.pugx.org/th3mouk/reactive-klaviyo/v/stable)](https://packagist.org/packages/th3mouk/reactive-klaviyo)
[![Latest Unstable Version](https://poser.pugx.org/th3mouk/reactive-klaviyo/v/unstable)](https://packagist.org/packages/th3mouk/reactive-klaviyo)
[![Total Downloads](https://poser.pugx.org/th3mouk/reactive-klaviyo/downloads)](https://packagist.org/packages/th3mouk/reactive-klaviyo)
[![License](https://poser.pugx.org/th3mouk/reactive-klaviyo/license)](https://packagist.org/packages/th3mouk/reactive-klaviyo)

[![Build Status](https://travis-ci.org/th3mouk/reactive-klaviyo.svg?branch=master)](https://travis-ci.org/th3mouk/reactive-klaviyo)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/th3mouk/reactive-klaviyo/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/th3mouk/reactive-klaviyo/?branch=master)

## Installation

`composer require th3mouk/reactive-klaviyo`

## Basic usage

### Create an instance of HttpClient

```php
use Clue\React\Buzz\Browser as ClueBrowser;
use Rxnet\HttpClient\Browser as RxBrowser;

$clue = new ClueBrowser(EventLoop::getLoop());
$httpClient = new RxBrowser($clue);
```

### Instantiate Klaviyo Client 

```php
$client = new Client('klaviyo-api-token', $httpClient);
```

### Create a payload

According to [Klaviyo documentation](https://www.klaviyo.com/docs), the payload 
must be base64 encoded.
This library use fluent setters to ease its creation and enforce typing with a
`Property` class.

```php
$payload = Payload::create('event-name')
    ->addCustomerProperty(Property::create('$email', 'polo@klaviyo.com'))
    ->addCustomerProperty(Property::create('$id', 'uuid-or-whatever'))
    ->addProperty(Property::create('lang', 'fr'))
    ->addProperty(Property::create('amount', 56))
    ->definePastEventDate(1559722012)
;
```

### Send

Two methods are available, the same that in documentation.

```php
$client->track(Payload $payload)
$client->trackOnce(Payload $payload)
```

## Please

Feel free to improve this library.
