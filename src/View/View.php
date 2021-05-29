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
     * @param string $baseUrl
     */
    public function __construct(array $templatePaths, string $compiledPath, string $baseUrl)
    {
        $this->templatePath = $templatePaths;
        $this->compiledPath = $compiledPath;
        $this->baseUrl = $baseUrl;
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
