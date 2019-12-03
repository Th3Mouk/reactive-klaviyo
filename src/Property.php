<?php

declare(strict_types=1);

namespace Th3Mouk\ReactiveKlaviyo;

final class Property
{
    /** @var string */
    private $name;
    /** @var string|int|float|bool|array<string|int|float|bool> */
    private $value;

    /**
     * @param string|int|float|bool|array<string|int|float|bool> $value
     */
    private function __construct(string $name, $value)
    {
        $this->name  = $name;
        $this->value = $value;
    }

    /**
     * @param string|int|float|bool|array<string|int|float|bool> $value
     */
    public static function create(string $name, $value): self
    {
        return new self($name, $value);
    }

    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string|int|float|bool|array<string|int|float|bool>
     */
    public function value()
    {
        return $this->value;
    }
}
