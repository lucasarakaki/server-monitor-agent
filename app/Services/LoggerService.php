<?php

declare(strict_types = 1);

namespace App\Services;

class LoggerService
{
    /**
     * Class constructor
     * Stores the value in logFile.
     */
    public function __construct(
        /**
         * Save the file name.
         */
        private readonly string $logFile,
    ) {
    }

    /**
     * Class Log
     * Captures the log and saves it in the logs directory.
     */
    public function Log(string $message): void
    {
        $timestamp  = date('Y-m-d H:i:s');
        $logMessage = "[{$timestamp}] {$message}".PHP_EOL;
        file_put_contents($this->logFile, $logMessage, FILE_APPEND);
    }
}
