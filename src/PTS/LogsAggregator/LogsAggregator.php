<?php
declare(strict_types=1);

namespace PTS\LogsAggregator;

use Psr\Log\LoggerInterface;

class LogsAggregator implements LoggerInterface
{
    public const DEBUG = 100;
    public const INFO = 200;
    public const NOTICE = 250;
    public const WARNING = 300;
    public const ERROR = 400;
    public const CRITICAL = 500;
    public const ALERT = 550;
    public const EMERGENCY = 600;

    /** @var array */
    protected $records = [];

    public function addRecord(int $level, string $message, array $context = []): void
    {
        $this->records[] = [
            'level'   => $level,
            'message' => $message,
            'context' => $context,
        ];
    }

    /**
     * @return array
     */
    public function getRecords(): array
    {
        return $this->records;
    }

    public function reset(): void
    {
        $this->records = [];
    }

    /**
     * {@inheritdoc}
     */
    public function emergency($message, array $context = []): void
    {
        $this->addRecord(self::EMERGENCY, (string)$message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function alert($message, array $context = []): void
    {
        $this->addRecord(self::ALERT, (string)$message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function critical($message, array $context = []): void
    {
        $this->addRecord(self::CRITICAL, (string)$message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function error($message, array $context = []): void
    {
        $this->addRecord(self::ERROR, (string)$message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function warning($message, array $context = []): void
    {
        $this->addRecord(self::WARNING, (string)$message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function notice($message, array $context = []): void
    {
        $this->addRecord(self::NOTICE, (string)$message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function info($message, array $context = []): void
    {
        $this->addRecord(self::INFO, (string)$message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function debug($message, array $context = []): void
    {
        $this->addRecord(self::DEBUG, (string)$message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function log($level, $message, array $context = []): void
    {
        $this->addRecord($level, (string)$message, $context);
    }
}
