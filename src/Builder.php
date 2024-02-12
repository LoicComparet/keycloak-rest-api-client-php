<?php declare(strict_types=1);

namespace Fschmtt\Keycloak;

use Fschmtt\Keycloak\OAuth\GrantType;
use Fschmtt\Keycloak\OAuth\TokenStorage\InMemory as InMemoryTokenStorage;
use Fschmtt\Keycloak\OAuth\TokenStorageInterface;

class Builder
{
    private ?string $baseUri;

    private ?GrantType $grantType;

    private TokenStorageInterface $tokenStorage;

    public function __construct()
    {
        $this->tokenStorage = new InMemoryTokenStorage();
    }

    public function withBaseUri(string $baseUri): self
    {
        $this->baseUri = $baseUri;

        return $this;
    }

    public function withGrantType(GrantType $grantType): self
    {
        $this->grantType = $grantType;

        return $this;
    }

    public function withTokenStorage(TokenStorageInterface $tokenStorage): self
    {
        $this->tokenStorage = $tokenStorage;

        return $this;
    }

    public function build(): Keycloak
    {
        return new Keycloak(
            $this->baseUri,
            $this->grantType,
            $this->tokenStorage,
        );
    }
}
