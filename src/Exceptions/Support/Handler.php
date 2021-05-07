<?php

namespace Mjolnir\Exceptions\Support;

use Mjolnir\Exceptions\LoggerException;
use Throwable;
use Mjolnir\Contracts\ExceptionHandlerInterface;

class Handler implements ExceptionHandlerInterface
{

    /**
     * @var Logger
     */
    private $logger;

    /**
     * Handler constructor.
     * @param Logger $logger
     * @throws LoggerException
     */
    public function __construct(Logger $logger)
    {
        $this->setLogger($logger);
        $this->setExceptionHandler();
    }

    /**
     * @param Logger $logger
     */
    public function setLogger(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return void
     * @throws LoggerException
     */
    private function setExceptionHandler()
    {
        set_exception_handler(function (Throwable $e) {
            return $this->handle($e);
        });
    }

    /**
     * @param Throwable $e
     * @return mixed
     * @throws LoggerException
     */
    private function handle(Throwable $e)
    {
        return $this->report($e)
            ->render($e);
    }

    /**
     * @param Throwable $e
     * @return mixed
     */
    public function render(Throwable $e)
    {
        //TODO: Move to external file
        $template = "
            <div><h3>Something went wrong</h3></div>
            <div class='message'>
                <b>File:</b> {$this->logger->absToRelPath($e->getFile())} [<b>{$e->getLine()}</b>]:</b> {$e->getMessage()}
                 </br>
                <b><pre style='white-space: pre-line;'>{$e->getTraceAsString()}</pre></b>
            </div>
        ";

        wp_die($template, 'Oops');
    }

    /**
     * @param Throwable $e
     * @return $this
     * @throws LoggerException
     */
    public function report(Throwable $e): Handler
    {
        $this->logger->fatal($e->getMessage(), $e->getTrace());
        return $this;
    }
}
