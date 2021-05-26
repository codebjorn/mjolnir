<?php

namespace Mjolnir\View;

use eftec\bladeone\BladeOne;

class View extends BladeOne
{
    public function __construct(string $appPath)
    {
        $this->templatePath = [$appPath . '/resources/views'];
        $this->compiledPath = wp_upload_dir()['basedir'] . '/cache/views';
    }

    public function render(string $view, array $variables = [])
    {
        echo $this->run($view, $variables);
    }
}
