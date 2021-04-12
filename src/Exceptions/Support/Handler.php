<?php

namespace Mjolnir\Exceptions\Support;

use Throwable;
use Mjolnir\Contracts\ExceptionHandlerInterface;

class Handler implements ExceptionHandlerInterface
{

    private Logger $logger;

    /**
     * Handler constructor.
     * @param Logger $logger
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;

        $this->setExceptionHandler();
    }

    /**
     * @return mixed
     */
    private function setExceptionHandler()
    {
        set_exception_handler(fn(Throwable $e) => $this->handle($e));
    }

    /**
     * @param Throwable $e
     * @return mixed
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
                <b><pre>{$e->getTraceAsString()}</pre></b>
            </div>
        ";

        wp_die($template, 'Oops');
    }

    /**
     * @param Throwable $e
     * @return $this
     */
    public function report(Throwable $e)
    {
        $this->logger->fatal($e->getMessage(), $e->getTrace());
        return $this;
    }
}
