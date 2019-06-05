<?php

declare(strict_types=1);

namespace Th3Mouk\ReactiveKlaviyo;

final class Property
{
    /** @var string */
    private $name;
    /** @var string|string[]|bool|int|float */
    private $value;

    /**
     * @param string|string[]|bool|int|float $value
     */
    private function __construct(string $name, $value)
    {
        $this->name  = $name;
        $this->value = $value;
    }

    /**
     * @param string|string[]|bool|int|float $value
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
     * @return string|string[]|bool|int|float
     */
    public function value()
    {
        return $this->value;
    }
}
