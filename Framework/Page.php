<?php
namespace Framework;

use Framework\UserConnect;
use Framework\Page\PageExtension;
use Framework\App\AbstractFramework;
use Framework\App\ComponentFramework;

class Page
{
    protected $contentFile;
    protected $parameters = [];
    protected UserConnect $appUser;

    public function __construct()
    {
        $this->appUser = new UserConnect;
    }
    
    /**
     * addParameters
     *
     * @param  array $parameters
     * @return void
     */
    public function addParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }
    
    /**
     * getGeneratedPage
     *
     * @param  mixed $component
     * @return void
     */
    public function getGeneratedPage(string $component)
    {
        extract($this->parameters);

        //Ajoute aux paramètres envoyés à la page d'utilisateur connectée
        $appUser = $this->appUser->getUserConnect();
        
        ob_start();
        require $this->contentFile;
        $content = ob_get_clean();

        ob_start();
        require __ROOT__ . '/Application/template/' . lcfirst($component) . '/base.php';
        return ob_get_clean();
    }
    
    /**
     * setContentFile
     *
     * @param  mixed $contentFile
     * @return void
     */
    public function setContentFile($contentFile)
    {
        if (!is_string($contentFile) || empty($contentFile)) {
            throw new \InvalidArgumentException('La vue spécifiée est invalide');
        }

        $this->contentFile = $contentFile;
    }
}
