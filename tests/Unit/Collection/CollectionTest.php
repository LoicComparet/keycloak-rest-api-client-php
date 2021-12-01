<?php

declare(strict_types=1);

namespace Fschmtt\Keycloak\Collection;

use Fschmtt\Keycloak\Representation\Realm;
use Fschmtt\Keycloak\Representation\User;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public function testCanCreateCollectionWithExpectedRepresentations(): void
    {
        $collection = new UserCollection([
            new User(),
            new User(),
            new User(),
        ]);

        static::assertCount(3, $collection);
    }

    public function testThrowsExceptionIfUnexpectedRepresentationIsProvided(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage('UserCollection expects items to be User representation, Realm given');

        new UserCollection([
            new Realm(),
        ]);
    }

    public function testThrowsExceptionIfUnexpectedRepresentationShouldBeAdded(): void
    {
        $collection = new UserCollection([
            new User(),
        ]);

        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage('UserCollection expects items to be User representation, Realm given');

        $collection->add(new Realm());
    }

    public function testCanGetIterator(): void
    {
        $collection = new RealmCollection([
            new Realm(),
            new Realm(),
            new Realm(),
        ]);

        foreach ($collection as $realm) {
            static::assertInstanceOf(Realm::class, $realm);
        }
    }

    public function testSerializeEmptyCollection(): void
    {
        $collection = new RealmCollection([]);

        static::assertEquals([], $collection->jsonSerialize());
    }
}
