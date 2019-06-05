<?php

declare(strict_types=1);

use Kahlan\Plugin\Double;
use React\EventLoop\Factory;
use Rx\Observable;
use Rx\Scheduler;
use Rxnet\HttpClient\Browser;
use Th3Mouk\ReactiveKlaviyo\Client;
use Th3Mouk\ReactiveKlaviyo\Payload;
use Th3Mouk\ReactiveKlaviyo\Property;

describe('Client', function () {
    beforeAll(function () {
        Scheduler::setDefaultFactory(function () {
            return new Scheduler\EventLoopScheduler(Factory::create());
        });
    });

    beforeEach(function () {
        $this->browser = Double::instance(['extends' => Browser::class, 'methods' => ['__construct']]);
        allow($this->browser)->toReceive('get')->andReturn(Observable::of(1));
    });

    describe('/track endpoint', function () {
        it('The GET request must be correctly formatted', function () {
            $payload = Payload::create('test')
                ->addCustomerProperty(Property::create('$email', 'polo@klaviyo.fr'))
                ->addCustomerProperty(Property::create('$id', 'azfpuabzfpazugrpauzbfdazpiub'))
                ->addProperty(Property::create('lang', 'fr'))
                ->addProperty(Property::create('amount', 56))
                ->addProperty(Property::create('domain', 'klaviyo.io'))
                ->definePastEventDate(1559722012);

            $this->client = new Client('token', $this->browser);

            expect($this->browser)->toReceive('get')->with('https://a.klaviyo.com/api/track?data=eyJ0b2tlbiI6InRva2VuIiwiZXZlbnQiOiJ0ZXN0IiwiY3VzdG9tZXJfcHJvcGVydGllcyI6eyIkZW1haWwiOiJwb2xvQGtsYXZpeW8uZnIiLCIkaWQiOiJhemZwdWFiemZwYXp1Z3JwYXV6YmZkYXpwaXViIn0sInByb3BlcnRpZXMiOnsibGFuZyI6ImZyIiwiYW1vdW50Ijo1NiwiZG9tYWluIjoia2xhdml5by5pbyJ9LCJ0aW1lIjoxNTU5NzIyMDEyfQ==');

            $this->client->track($payload);
        });
    });

    describe('/track-once endpoint', function () {
        it('The GET request must be correctly formatted', function () {
            $payload = Payload::create('test')
                ->addCustomerProperty(Property::create('$email', 'polo@klaviyo.fr'))
                ->addCustomerProperty(Property::create('$id', 'azfpuabzfpazugrpauzbfdazpiub'))
                ->addProperty(Property::create('lang', 'fr'))
                ->addProperty(Property::create('amount', 56))
                ->addProperty(Property::create('domain', 'klaviyo.io'))
                ->definePastEventDate(1559722012);

            $this->client = new Client('token', $this->browser);

            expect($this->browser)->toReceive('get')->with('https://a.klaviyo.com/api/track-once?data=eyJ0b2tlbiI6InRva2VuIiwiZXZlbnQiOiJ0ZXN0IiwiY3VzdG9tZXJfcHJvcGVydGllcyI6eyIkZW1haWwiOiJwb2xvQGtsYXZpeW8uZnIiLCIkaWQiOiJhemZwdWFiemZwYXp1Z3JwYXV6YmZkYXpwaXViIn0sInByb3BlcnRpZXMiOnsibGFuZyI6ImZyIiwiYW1vdW50Ijo1NiwiZG9tYWluIjoia2xhdml5by5pbyJ9LCJ0aW1lIjoxNTU5NzIyMDEyfQ==');

            $this->client->trackOnce($payload);
        });
    });
});
