<?php

namespace App\Services;

class LoggerService
{
    /**
     * Save the file name
     *
     * @var string
     */
    private string $logFile;

    /**
     * Class constructor
     * Stores the value in logFile
     *
     * @param string $logFile
     */
    public function __construct(string $logFile)
    {
        $this->logFile = $logFile;
    }

    /**
     * Class Log
     * Captures the log and saves it in the logs directory
     *
     * @param  string $message
     * @return void
     */
    public function Log(string $message): void
    {
        $timestamp  = date('Y-m-d H:i:s');
        $logMessage = "[{$timestamp}] {$message}".PHP_EOL;
        file_put_contents($this->logFile, $logMessage, FILE_APPEND);
    }
}
