<?php

namespace AlgoYounes\QrForge\ValueObjects;

use Stringable;

abstract class ValueObject implements Stringable
{
    public function __construct(protected string $value)
    {
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getLength(): int
    {
        return strlen($this->value);
    }

    abstract public function __toString(): string;

    protected function toHex(int $value): string
    {
        return pack("H*", sprintf("%02X", $value));
    }
}
