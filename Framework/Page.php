<?php
namespace Framework;

use Framework\App\AbstractFramework;
use Framework\App\ComponentFramework;

class Page
{
    protected $contentFile;
    protected $parameters = [];

    public function addParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }

    public function getGeneratedPage(string $component)
    {
        extract($this->parameters);

        ob_start();
        require $this->contentFile;
        $content = ob_get_clean();

        ob_start();
        require dirname(__DIR__) . '/Application/template/' . lcfirst($component) . '/base.php';
        return ob_get_clean();
    }

    public function setContentFile($contentFile)
    {
        if (!is_string($contentFile) || empty($contentFile)) {
            throw new \InvalidArgumentException('La vue spécifiée est invalide');
        }

        $this->contentFile = $contentFile;
    }
}
