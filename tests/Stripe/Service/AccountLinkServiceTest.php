<?php

declare(strict_types=1);

namespace Stripe\Service;

/**
 * @internal
 * @covers \Stripe\Service\AccountLinkService
 */
final class AccountLinkServiceTest extends \PHPUnit\Framework\TestCase
{
    use \Stripe\TestHelper;

    /** @var \Stripe\StripeClient */
    private $client;

    /** @var AccountLinkService */
    private $service;

    /**
     * @before
     */
    protected function setUpService(): void
    {
        $this->client = new \Stripe\StripeClient(['api_key' => 'sk_test_123', 'api_base' => MOCK_URL]);
        $this->service = new AccountLinkService($this->client);
    }

    public function testCreate(): void
    {
        $this->expectsRequest(
            'post',
            '/v1/account_links'
        );
        $resource = $this->service->create([
            'account' => 'acct_123',
            'refresh_url' => 'https://stripe.com/refresh_url',
            'return_url' => 'https://stripe.com/return_url',
            'type' => 'account_onboarding',
        ]);
        static::assertInstanceOf(\Stripe\AccountLink::class, $resource);
    }
}
