<?php declare(strict_types=1);

namespace Fschmtt\Keycloak\Resource;

use ArrayIterator;
use Fschmtt\Keycloak\Exception\ResourceAlreadyRegisteredException;

class Registry extends ArrayIterator
{
    /**
     * @var array<class-string<Resource>>
     */
    private array $resources;

    public function __construct()
    {
        $this->resources = [
            AttackDetection::class,
            Clients::class,
            Groups::class,
            Realms::class,
            Roles::class,
            ServerInfo::class,
            Users::class,
        ];

        parent::__construct();
    }

    /**
     * @param class-string<Resource> $resource
     */
    public function add(string $resource): void
    {
        if (in_array($resource, $this->resources, true)) {
            throw new ResourceAlreadyRegisteredException($resource);
        }

        $this->resources[] = $resource;
    }

    /**
     * @param class-string<Resource> $resource
     */
    public function remove(string $resource): void
    {
        if (!in_array($resource, $this->resources, true)) {
            return;
        }

        unset($this->resources[$resource]);
    }
}