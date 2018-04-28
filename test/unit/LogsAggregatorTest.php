<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PTS\LogsAggregator\LogsAggregator;


class LogsAggregatorTest extends TestCase
{
    /** @var LogsAggregator */
    protected $logs;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        parent::setUp();

        $this->logs = new LogsAggregator;
    }

    /**
     * @covers \PTS\LogsAggregator\LogsAggregator::addRecord()
     */
    public function testAddRecord(): void
    {
        $this->logs->addRecord(100, 'log a', ['uid' => 1]);
        $records = $this->logs->getRecords();

        self::assertCount(1, $records);
        self::assertSame([
            [
                'level'   => 100,
                'message' => 'log a',
                'context' => ['uid' => 1],
            ]
        ], $records);
    }

    /**
     * @covers \PTS\LogsAggregator\LogsAggregator::getRecords()
     */
    public function testGetRecords(): void
    {
        $this->logs->addRecord(100, 'log b', ['uid' => 1]);
        $records = $this->logs->getRecords();

        self::assertCount(1, $records);
        self::assertSame([
            [
                'level'   => 100,
                'message' => 'log b',
                'context' => ['uid' => 1],
            ]
        ], $records);
    }

    /**
     * @covers \PTS\LogsAggregator\LogsAggregator::reset()
     */
    public function testReset(): void
    {
        $this->logs->addRecord(100, 'log c', ['uid' => 1]);
        $this->logs->reset();
        $records = $this->logs->getRecords();

        self::assertCount(0, $records);
        self::assertSame([], $records);
    }

    /**
     * @covers \PTS\LogsAggregator\LogsAggregator::log()
     */
    public function testLog(): void
    {
        $message = 'log';
        $context = ['uid' => 1];

        $this->logs->log(LogsAggregator::INFO, $message, $context);
        $records = $this->logs->getRecords();

        self::assertCount(1, $records);
        self::assertSame([
            [
                'level'   => LogsAggregator::INFO,
                'message' => $message,
                'context' => $context
            ]
        ], $records);
    }

    /**
     * @param string $method
     * @param int $level
     * @param string $message
     * @param array $context
     *
     * @covers \PTS\LogsAggregator\LogsAggregator::emergency()
     * @covers \PTS\LogsAggregator\LogsAggregator::alert()
     * @covers \PTS\LogsAggregator\LogsAggregator::critical()
     * @covers \PTS\LogsAggregator\LogsAggregator::error()
     * @covers \PTS\LogsAggregator\LogsAggregator::warning()
     * @covers \PTS\LogsAggregator\LogsAggregator::notice()
     * @covers \PTS\LogsAggregator\LogsAggregator::info()
     * @covers \PTS\LogsAggregator\LogsAggregator::debug()
     *
     * @dataProvider dataProviderLogMethods
     */
    public function testLogMethod(string $method, int $level, string $message, array $context): void
    {
        $this->logs->{$method}($message, $context);
        $records = $this->logs->getRecords();

        self::assertCount(1, $records);
        self::assertSame([
            [
                'level'   => $level,
                'message' => $message,
                'context' => $context
            ]
        ], $records);
    }

    public function dataProviderLogMethods(): array
    {
        return [
            'debug' => ['debug', LogsAggregator::DEBUG, 'debug.message', ['uid' => 1]],
            'info' => ['info', LogsAggregator::INFO, 'info.message', ['uid' => 2]],
            'notice' => ['notice', LogsAggregator::NOTICE, 'notice.message', ['uid' => 3]],
            'warning' => ['warning', LogsAggregator::WARNING, 'warning.message', ['uid' => 4]],
            'error' => ['error', LogsAggregator::ERROR, 'error.message', ['uid' => 5]],
            'critical' => ['critical', LogsAggregator::CRITICAL, 'critical.message', ['uid' => 6]],
            'alert' => ['alert', LogsAggregator::ALERT, 'alert.message', ['uid' => 7]],
            'emergency' => ['emergency', LogsAggregator::EMERGENCY, 'emergency.message', ['uid' => 8]],
        ];
    }

}