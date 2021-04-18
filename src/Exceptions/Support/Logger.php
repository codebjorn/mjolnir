<?php

namespace Mjolnir\Exceptions\Support;

use Mjolnir\Contracts\ExceptionLoggerInterface;
use Mjolnir\Exceptions\LoggerException;
use Mjolnir\Support\Is;

class Logger implements ExceptionLoggerInterface
{
    protected string $logFile;
    protected $file;
    protected array $options;

    /**
     * Logger constructor.
     * @param string $logFile
     * @param string $file
     * @param array $options
     */
    public function __construct(string $logFile = "", string $file = "", array $options = [])
    {
        $this->logFile = $logFile ?: $_SERVER['DOCUMENT_ROOT'] . "/logs/error.log";
        $this->file = $file;
        $this->options = $options ?: [
            'dateFormat' => 'd-M-Y',
            'logFormat' => 'H:i:s d-M-Y'
        ];
    }

    /**
     *
     */
    public function createLogFile()
    {
        if (!Is::dir($_SERVER['DOCUMENT_ROOT'] . '/logs')) {
            mkdir($_SERVER['DOCUMENT_ROOT'] . '/logs', 0777, true);
        }

        if (!Is::file($this->logFile)) {
            fopen($this->logFile, 'w') or exit("Can't create {$this->logFile}");
        }

        if (!Is::writable($this->logFile)) {
            throw new LoggerException("Unable to write to file");
        }
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions($options = [])
    {
        $this->options = array_merge($this->options, $options);

        return $this;
    }

    /**
     * @param $message
     * @param array $context
     * @throws LoggerException
     */
    public function info($message, array $context = [])
    {
        $bt = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1);

        $this->writeLog([
            'message' => $message,
            'bt' => $bt,
            'severity' => 'INFO',
            'context' => $context
        ]);
    }

    /**
     * @param $message
     * @param array $context
     * @throws LoggerException
     */
    public function notice($message, array $context = [])
    {
        $bt = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1);

        $this->writeLog([
            'message' => $message,
            'bt' => $bt,
            'severity' => 'NOTICE',
            'context' => $context
        ]);
    }

    /**
     * @param $message
     * @param array $context
     * @throws LoggerException
     */
    public function debug($message, array $context = [])
    {

        $bt = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1);

        $this->writeLog([
            'message' => $message,
            'bt' => $bt,
            'severity' => 'DEBUG',
            'context' => $context
        ]);
    }

    /**
     * @param $message
     * @param array $context
     * @throws LoggerException
     */
    public function warning($message, array $context = [])
    {
        $bt = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1);

        $this->writeLog([
            'message' => $message,
            'bt' => $bt,
            'severity' => 'WARNING',
            'context' => $context
        ]);
    }

    /**
     * @param $message
     * @param array $context
     * @throws LoggerException
     */
    public function error($message, array $context = [])
    {
        $bt = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1);

        $this->writeLog([
            'message' => $message,
            'bt' => $bt,
            'severity' => 'ERROR',
            'context' => $context
        ]);
    }

    /**
     * @param $message
     * @param array $context
     * @throws LoggerException
     */
    public function fatal($message, array $context = [])
    {
        $bt = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1);

        $this->writeLog([
            'message' => $message,
            'bt' => $bt,
            'severity' => 'FATAL',
            'context' => $context
        ]);
    }

    /**
     * @param array $args
     * @throws LoggerException
     */
    public function writeLog($args = [])
    {
        $this->createLogFile();

        if (!Is::res($this->logFile)) {
            $this->openLog();
        }

        $time = date($this->options['logFormat']);

        $context = $this->prettyTrace($args['context']);

        $caller = array_shift($args['bt']);
        $btLine = $caller['line'];
        $btPath = $caller['file'];

        $path = $this->absToRelPath($btPath);

        $timeLog = is_null($time) ? "[N/A] " : "[{$time}] ";
        $pathLog = is_null($path) ? "[N/A] " : "[{$path}] ";
        $lineLog = is_null($btLine) ? "[N/A] " : "[{$btLine}] ";
        $severityLog = is_null($args['severity']) ? "[N/A]" : "[{$args['severity']}]";
        $messageLog = is_null($args['message']) ? "N/A" : "{$args['message']}";
        $contextLog = empty($args['context']) ? "" : "{$context}";

        fwrite($this->file, "{$timeLog}{$pathLog}{$lineLog}: {$severityLog} - {$messageLog} " . PHP_EOL . "{$contextLog}" . PHP_EOL);

        $this->closeFile();
    }

    /**
     *
     */
    private function openLog()
    {
        $openFile = $this->logFile;
        $this->file = fopen($openFile, 'a') or exit("Unable to open file {$openFile}");
    }

    /**
     *
     */
    public function closeFile()
    {
        if ($this->file) {
            fclose($this->file);
        }
    }

    /**
     * @param $pathToConvert
     * @return string
     */
    public function absToRelPath($pathToConvert)
    {
        $pathAbs = str_replace(['/', '\\'], '/', $pathToConvert);
        $documentRoot = str_replace(['/', '\\'], '/', $_SERVER['DOCUMENT_ROOT']);
        return $_SERVER['SERVER_NAME'] . str_replace($documentRoot, '', $pathAbs);
    }

    /**
     * @param $trace
     * @param string $newLine
     * @return string|string[]|null
     */
    public function prettyTrace($trace, $newLine = PHP_EOL)
    {
        $context = json_encode($trace, JSON_UNESCAPED_SLASHES);
        return preg_replace('/},/', "}," . $newLine, $context);
    }

}
