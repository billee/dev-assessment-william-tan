<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WeatherMetricsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WeatherMetricsTable Test Case
 */
class WeatherMetricsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\WeatherMetricsTable
     */
    protected $WeatherMetrics;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.WeatherMetrics',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('WeatherMetrics') ? [] : ['className' => WeatherMetricsTable::class];
        $this->WeatherMetrics = $this->getTableLocator()->get('WeatherMetrics', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->WeatherMetrics);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\WeatherMetricsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
