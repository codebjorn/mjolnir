<?php

namespace Mjolnir\View;

use eftec\bladeone\BladeOne;
use Exception;

class View extends BladeOne
{
    /**
     * View constructor.
     * @param array $templatePaths
     * @param string $compiledPath
     */
    public function __construct(array $templatePaths, string $compiledPath)
    {
        $this->templatePath = $templatePaths;
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
