<?php

declare(strict_types=1);

namespace Th3Mouk\ReactiveKlaviyo;

final class Payload
{
    /** @var string */
    private $event;

    /** @var Property[] */
    private $customer_properties = [];

    /** @var Property[] */
    private $properties = [];

    /** @var int|null */
    private $event_occured_at;

    private function __construct(string $event)
    {
        $this->event = $event;
    }

    public static function create(string $event): self
    {
        return new self($event);
    }

    public function addCustomerProperty(Property $customer_property): self
    {
        $this->customer_properties[] = $customer_property;

        return $this;
    }

    public function addProperty(Property $property): self
    {
        $this->properties[] = $property;

        return $this;
    }

    public function definePastEventDate(int $timestamp): self
    {
        $this->event_occured_at = $timestamp;

        return $this;
    }

    public function event(): string
    {
        return $this->event;
    }

    /**
     * @return Property[]
     */
    public function customerProperties(): array
    {
        return $this->customer_properties;
    }

    /**
     * @return Property[]
     */
    public function properties(): array
    {
        return $this->properties;
    }

    public function eventOccurredAt(): ?int
    {
        return $this->event_occured_at;
    }

    /**
     * @param Property[] $properties
     *
     * @return array<string, string|string[]|bool|int|float>
     */
    private function reduceProperties(array $properties): array
    {
        $reduced = [];

        /** @var Property $property */
        foreach ($properties as $property) {
            $reduced[$property->name()] = $property->value();
        }

        return $reduced;
    }

    /**
     * @return array<string, string|int|array<string, string|string[]|bool|int|float>>
     */
    public function toArray(): array
    {
        $optional = [];

        if (null !== $this->eventOccurredAt()) {
            $optional['time'] = $this->eventOccurredAt();
        }

        return array_merge([
            'event' => $this->event(),
            'customer_properties' => $this->reduceProperties($this->customerProperties()),
            'properties' => $this->reduceProperties($this->properties()),
        ], $optional);
    }
}
