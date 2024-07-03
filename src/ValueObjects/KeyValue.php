<?php

namespace AlgoYounes\QrForge\ValueObjects;

class KeyValue extends ValueObject
{
    public function __construct(
        protected string $key,
        protected string $value
    ) {
        parent::__construct($value);
    }

    public static function create(string $key, string $value): self
    {
        return new self($key, $value);
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function __toString(): string
    {
        return sprintf("%s:%s", $this->key, $this->value);
    }
}
