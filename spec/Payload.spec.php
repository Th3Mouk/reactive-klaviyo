<?php

declare(strict_types=1);

use Th3Mouk\ReactiveKlaviyo\Payload;
use Th3Mouk\ReactiveKlaviyo\Property;

describe('Payload', function () {
    it('must be correctly serialized', function () {
        $payload = Payload::create('test')
            ->addCustomerProperty(Property::create('$email', 'polo@klaviyo.fr'))
            ->addCustomerProperty(Property::create('$id', 'azfpuabzfpazugrpauzbfdazpiub'))
            ->addProperty(Property::create('lang', 'fr'))
            ->addProperty(Property::create('amount', 56))
            ->addProperty(Property::create('domain', 'klaviyo.io'))
            ->addProperty(Property::create('scalar_list', ['string', 1, 1.0, true]))
            ->definePastEventDate(1559722012)
            ->toArray();

        expect($payload)->toBe([
            'event' => 'test',
            'customer_properties' => [
                '$email' => 'polo@klaviyo.fr',
                '$id' => 'azfpuabzfpazugrpauzbfdazpiub',
            ],
            'properties' => [
                'lang' => 'fr',
                'amount' => 56,
                'domain' => 'klaviyo.io',
                'scalar_list' => ['string', 1, 1.0, true],
            ],
            'time' => 1559722012,
        ]);
    });

    it('must omit the time when not defined', function () {
        $payload = Payload::create('test')
            ->addCustomerProperty(Property::create('$email', 'polo@klaviyo.fr'))
            ->addCustomerProperty(Property::create('$id', 'azfpuabzfpazugrpauzbfdazpiub'))
            ->addProperty(Property::create('lang', 'fr'))
            ->addProperty(Property::create('amount', 56))
            ->addProperty(Property::create('domain', 'klaviyo.io'))
            ->toArray();

        expect($payload)->toBe([
            'event' => 'test',
            'customer_properties' => [
                '$email' => 'polo@klaviyo.fr',
                '$id' => 'azfpuabzfpazugrpauzbfdazpiub',
            ],
            'properties' => [
                'lang' => 'fr',
                'amount' => 56,
                'domain' => 'klaviyo.io',
            ],
        ]);
    });
});
