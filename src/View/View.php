<?php

namespace Mjolnir\View;

use eftec\bladeone\BladeOne;
use Exception;

class View extends BladeOne
{
    /**
     * View constructor.
     * @param string $appPath
     */
    public function __construct(string $appPath)
    {
        $this->templatePath = [$appPath . '/resources/views'];
        $this->compiledPath = wp_upload_dir()['basedir'] . '/cache/views';
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
