<?php

namespace AlgoYounes\QrForge;

use AlgoYounes\QrForge\ValueObjects\ValueObject;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class QrForge
{
    protected QROptions $qrOptions;

    /**
     * Create a new QrForge instance.
     *
     * @param ValueObject[] $items Array of ValueObject instances.
     */
    public function __construct(
        protected array $items
    ) {
        $this->items = array_filter($items, static fn($item): bool => $item instanceof ValueObject);
    }

    /**
     * Create a new QrForge instance.
     *
     * @param ValueObject[] $items Array of ValueObject instances.
     */
    public static function fromArray(array $items = []): self
    {
        return new self($items);
    }

    /**
     * Add a ValueObject item to the list.
     *
     * @return $this
     */
    public function withItem(ValueObject $item): self
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Set QR code options.
     *
     * @param array<string, mixed> $options Configuration options for QROptions.
     * @return $this
     */
    public function withOptions(array $options): self
    {
        $this->qrOptions = new QROptions($options);

        return $this;
    }

    /**
     * Get the current QR code options.
     */
    public function getOptions(): QROptions
    {
        return $this->qrOptions;
    }

    /**
     * Convert the list of items to TLV string format.
     */
    public function toTLV(): string
    {
        return implode('', array_map(fn(ValueObject $item): string => (string)$item, $this->items));
    }

    /**
     * Get the Base64 encoded QR code data.
     */
    public function toBase64(): string
    {
        return base64_encode($this->toTLV());
    }

    /**
     * Generate the QR code image with optional configurations.
     *
     * @param string|null $file Path to save the QR code image, or null to return Base64 string.
     */
    public function render(string $file = null): mixed
    {
        $qrCode = new QRCode($this->qrOptions);
        if ($file === null) {
            return $qrCode->render($this->toTLV());
        }

        return $qrCode->render($this->toTLV(), $file);
    }
}
