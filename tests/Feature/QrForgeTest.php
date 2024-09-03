<?php

namespace AlgoYounes\QrForge\Tests\Feature;

use AlgoYounes\QrForge\QrForge;
use AlgoYounes\QrForge\Tests\TestCase;
use AlgoYounes\QrForge\ValueObjects\KeyValue;
use AlgoYounes\QrForge\ValueObjects\Tag;

class QrForgeTest extends TestCase
{
    public function it_can_add_items_and_generate_tlv(): void
    {
        $qrForge = QrForge::fromArray([
            KeyValue::create('name', 'John Doe'),
            Tag::create(1, '1234567890')
        ]);

        $expectedTLV = '6e616d653a4a6f686e20446f65010a31323334353637383930';
        $this->assertEquals($expectedTLV, bin2hex($qrForge->toTLV()));
    }

    public function it_can_generate_base64_encoded_qr_code(): void
    {
        $qrForge = QrForge::fromArray(
            [
                KeyValue::create('email', 'john.doe@example.com'),
            ]
        );

        $qrForge->withOptions([
            'outputType' => 'svg'
        ]);

        $base64 = $qrForge->toBase64();

        $this->assertNotEmpty($base64);
        $this->assertTrue($this->isValidBase64($base64));
    }

    public function it_can_render_qr_code_image(): void
    {
        $qrForge = QrForge::fromArray([
            Tag::create(2, '2024-01-01')
        ]);

        $qrForge->withOptions([
            'outputType' => 'data-uri'
        ]);

        $image = $qrForge->render();

        $this->assertNotEmpty($image);
        $this->assertStringStartsWith('data:image/', $image);

        $base64Image = preg_replace('#^data:image/\w+;base64,#i', '', $image);
        $decodedImage = base64_decode($base64Image);

        $this->assertNotEmpty($decodedImage);
    }

    private function toHex(int $value): string
    {
        return strtoupper(dechex($value));
    }

    private function isValidBase64(string $data): bool
    {
        return base64_decode($data, true) !== false;
    }
}
