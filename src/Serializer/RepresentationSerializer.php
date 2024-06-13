<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Serializer;

use Fschmtt\Keycloak\Representation\Representation;

/**
 * @internal
 */
class RepresentationSerializer implements SerializerInterface
{
    public function serializes(): string
    {
        return Representation::class;
    }

    /**
     * @param class-string<Representation> $type
     */
    public function serialize(string $type, mixed $value): Representation
    {
        return $type::from($value);
    }
}
