<?php

namespace Mjolnir\View;

use eftec\bladeone\BladeOne;
use Exception;

class View extends BladeOne
{
    /**
     * View constructor.
     * @param string $templatePath
     * @param string $compiledPath
     */
    public function __construct(string $templatePath, string $compiledPath)
    {
        $this->templatePath = [$templatePath];
        $this->compiledPath = $compiledPath;
    }

    /**
     * @param string $view
     * @param array $variables
     * @throws Exception
     */
    public function render(string $view, array $variables = [])
    {
        echo $this->run($view, $variables);
    }
}
