<?php

declare(strict_types=1);

namespace Th3Mouk\ReactiveKlaviyo;

use Rx\Observable;
use Rxnet\HttpClient\Browser;

final class Client
{
    private const TRACKING_API_URL = 'https://a.klaviyo.com/api';
    /** @var string */
    private $token;
    /** @var Browser */
    private $browser;

    public function __construct(
        string $token,
        Browser $browser
    ) {
        $this->token   = $token;
        $this->browser = $browser;
    }

    public function track(Payload $payload): Observable
    {
        return $this->browser->get(
            self::TRACKING_API_URL . '/track?data=' . $this->encodePayload($payload)
        );
    }

    public function trackOnce(Payload $payload): Observable
    {
        return $this->browser->get(
            self::TRACKING_API_URL . '/track-once?data=' . $this->encodePayload($payload)
        );
    }

    private function encodePayload(Payload $payload): string
    {
        $json = \json_encode(
            array_merge(
                ['token' => $this->token],
                $payload->toArray()
            ),
            JSON_THROW_ON_ERROR
        );

        return base64_encode($json);
    }
}
