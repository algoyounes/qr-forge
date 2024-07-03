<?php

namespace AlgoYounes\QrForge\ValueObjects;

class Tag extends ValueObject
{
    public function __construct(
        protected int $tag,
        protected string $value
    ) {
        parent::__construct($value);
    }

    public static function create(int $tag, string $value): self
    {
        return new self($tag, $value);
    }

    public function getTag(): int
    {
        return $this->tag;
    }

    public function __toString(): string
    {
        return sprintf("%s%s%s", $this->toHex($this->getTag()), $this->toHex($this->getLength()), $this->value);
    }
}
