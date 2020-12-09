<?php

declare(strict_types=1);

namespace Stripe\Reporting;

/**
 * @internal
 * @covers \Stripe\Reporting\ReportType
 */
final class ReportTypeTest extends \PHPUnit\Framework\TestCase
{
    use \Stripe\TestHelper;

    const TEST_RESOURCE_ID = 'activity.summary.1';

    public function testIsListable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/reporting/report_types'
        );
        $resources = ReportType::all();
        static::assertInternalType('array', $resources->data);
        static::assertInstanceOf(\Stripe\Reporting\ReportType::class, $resources->data[0]);
    }

    public function testIsRetrievable(): void
    {
        $this->expectsRequest(
            'get',
            '/v1/reporting/report_types/' . self::TEST_RESOURCE_ID
        );
        $resource = ReportType::retrieve(self::TEST_RESOURCE_ID);
        static::assertInstanceOf(\Stripe\Reporting\ReportType::class, $resource);
    }
}
