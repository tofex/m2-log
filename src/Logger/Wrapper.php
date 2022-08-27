<?php

namespace Tofex\Log\Logger;

use Psr\Log\LoggerInterface;

/**
 * @author      Andreas Knollmann
 * @copyright   Copyright (c) 2014-2022 Tofex UG (http://www.tofex.de)
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
class Wrapper
    implements LoggerInterface
{
    /** @var LoggerInterface */
    private $defaultLogger;

    /** @var LoggerInterface[] */
    private $loggers = [];

    /** @var bool */
    private $initialized = false;

    /**
     * @param LoggerInterface|null $defaultLogger
     */
    public function __construct(LoggerInterface $defaultLogger = null)
    {
        $this->defaultLogger = $defaultLogger;
    }

    /**
     * @return void
     */
    protected function checkInitialized()
    {
        if ( ! $this->initialized) {
            $this->initialize();
            $this->initialized = true;
        }
    }

    /**
     * @return void
     */
    public function initialize()
    {
        if ($this->defaultLogger !== null) {
            $this->addLoggers([$this->defaultLogger]);
        }
    }

    /**
     * @param LoggerInterface[] $loggers
     */
    public function addLoggers(array $loggers = [])
    {
        foreach ($loggers as $logger) {
            if ($logger instanceof LoggerInterface) {
                $this->loggers[] = $logger;
            }
        }
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function emergency($message, array $context = [])
    {
        $this->checkInitialized();

        foreach ($this->loggers as $logger) {
            $logger->emergency($message, $context);
        }
    }

    /**
     * Action must be taken immediately.
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function alert($message, array $context = [])
    {
        $this->checkInitialized();

        foreach ($this->loggers as $logger) {
            $logger->alert($message, $context);
        }
    }

    /**
     * Critical conditions.
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function critical($message, array $context = [])
    {
        $this->checkInitialized();

        foreach ($this->loggers as $logger) {
            $logger->critical($message, $context);
        }
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function error($message, array $context = [])
    {
        $this->checkInitialized();

        foreach ($this->loggers as $logger) {
            $logger->error($message, $context);
        }
    }

    /**
     * Exceptional occurrences that are not errors.
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function warning($message, array $context = [])
    {
        $this->checkInitialized();

        foreach ($this->loggers as $logger) {
            $logger->warning($message, $context);
        }
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function notice($message, array $context = [])
    {
        $this->checkInitialized();

        foreach ($this->loggers as $logger) {
            $logger->notice($message, $context);
        }
    }

    /**
     * Interesting events.
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function info($message, array $context = [])
    {
        $this->checkInitialized();

        foreach ($this->loggers as $logger) {
            $logger->info($message, $context);
        }
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function debug($message, array $context = [])
    {
        $this->checkInitialized();

        foreach ($this->loggers as $logger) {
            $logger->debug($message, $context);
        }
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed  $level
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function log($level, $message, array $context = [])
    {
        $this->checkInitialized();

        foreach ($this->loggers as $logger) {
            $logger->log($level, $message, $context);
        }
    }
}
