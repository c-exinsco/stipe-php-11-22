<?php

declare(strict_types=1);

namespace Stripe;

/**
 * @internal
 * @covers \Stripe\EphemeralKey
 */
final class EphemeralKeyTest extends \PHPUnit\Framework\TestCase
{
    use TestHelper;

    public function testIsCreatable(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/ephemeral_keys',
            null,
            ['Stripe-Version: 2017-05-25']
        );
        $resource = EphemeralKey::create([
            'customer' => 'cus_123',
        ], ['stripe_version' => '2017-05-25']);
        static::assertInstanceOf(\Stripe\EphemeralKey::class, $resource);
    }

    public function testIsNotCreatableWithoutAnExplicitApiVersion(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $resource = EphemeralKey::create([
            'customer' => 'cus_123',
        ]);
    }

    public function testIsDeletable(): void
    {
        $key = EphemeralKey::create([
            'customer' => 'cus_123',
        ], ['stripe_version' => '2017-05-25']);
        $this->expectsRequest(
            'delete',
            '/v1/ephemeral_keys/' . $key->id
        );
        $resource = $key->delete();
        static::assertInstanceOf(\Stripe\EphemeralKey::class, $resource);
    }
}
