<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\OAuth;

abstract class GrantType
{
    public function __construct(
        public readonly string $grantType,
        public readonly string $clientId,
        public readonly ?string $clientSecret = null,
        public readonly ?string $scope = null,
    ) {
    }

    /**
     * @return array<string, string>
     */
    abstract public function toRequestParams(): array;
}
