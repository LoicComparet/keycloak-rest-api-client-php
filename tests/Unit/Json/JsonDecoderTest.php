<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Test\Unit\Json;

use Fschmtt\Keycloak\Exception\JsonDecodeException;
use Fschmtt\Keycloak\Json\JsonDecoder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(JsonDecoder::class)]
class JsonDecoderTest extends TestCase
{
    private JsonDecoder $decoder;

    protected function setUp(): void
    {
        $this->decoder = new JsonDecoder();
    }

    public function testCanDecode(): void
    {
        self::assertSame(
            [
                'Hey' => 'I am a valid JSON string!',
            ],
            $this->decoder->decode('{"Hey": "I am a valid JSON string!"}'),
        );
    }

    public function testThrowsExceptionOnMalformedJson(): void
    {
        $this->expectException(JsonDecodeException::class);

        $this->decoder->decode('{3:abcd"}');
    }
}
