<?php

declare(strict_types=1);

namespace Stripe\Service;

/**
 * @internal
 * @covers \Stripe\Service\SubscriptionScheduleService
 */
final class SubscriptionScheduleServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Stripe\TestHelper;

    const TEST_RESOURCE_ID = 'sub_sched_123';
    const TEST_REVISION_ID = 'sub_sched_rev_123';

    /** @var \Stripe\StripeClient */
    private $client;

    /** @var SubscriptionScheduleService */
    private $service;

    /**
     * @before
     */
    protected function setUpService(): void
    {
        $this->client = new \Stripe\StripeClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new SubscriptionScheduleService($this->client);
    }

    public function testAll(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/subscription_schedules'
        );
        $resources = $this->service->all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Stripe\SubscriptionSchedule::class, $resources->data[0]);
    }

    public function testCancel(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/subscription_schedules/' . self::TEST_RESOURCE_ID . '/cancel'
        );
        $resource = $this->service->cancel(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\SubscriptionSchedule::class, $resource);
    }

    public function testCreate(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/subscription_schedules'
        );
        $resource = $this->service->create([
            'phases' => [
                [
                    'items' => [
                        ['price' => 'price_123', 'quantity' => 2],
                    ],
                ],
            ],
        ]);
        static::assertInstanceOf(\Stripe\SubscriptionSchedule::class, $resource);
    }

    public function testRelease(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/subscription_schedules/' . self::TEST_RESOURCE_ID . '/release'
        );
        $resource = $this->service->release(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\SubscriptionSchedule::class, $resource);
    }

    public function testRetrieve(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/subscription_schedules/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\SubscriptionSchedule::class, $resource);
    }

    public function testUpdate(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/subscription_schedules/' . self::TEST_RESOURCE_ID
        );
        $resource = $this->service->update(self::TEST_RESOURCE_ID, [
            'metadata' => ['key' => 'value'],
        ]);
        static::assertInstanceOf(\Stripe\SubscriptionSchedule::class, $resource);
    }
}
