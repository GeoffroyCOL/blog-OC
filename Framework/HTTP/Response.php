<?php

namespace Framework\HTTP;

use Framework\Page;

class Response
{
    protected Page $page;
    
    /**
     * addHeader
     *
     * @param  string $header
     * @return void
     */
    public function addHeader(string $header): void
    {
        header($header);
    }
    
    /**
     * redirect
     *
     * @param  string $location
     * @return void
     */
    public function redirect(string $location): void
    {
        header('Location: '.$location);
        exit;
    }
    
    /**
     * redirect404
     *
     * @return void
     */
    public function redirect404(): void
    {
        $this->page = new Page();
        $this->page->setContentFile(__ROOT__ . '/Application/template/errors/404.php');
        
        $this->addHeader('HTTP/1.0 404 Not Found');
        
        $this->send();
    }

    /**
     * redirect403
     *
     * @return void
     */
    public function redirectError(int $statusCode): void
    {
        $this->redirect('/'.$statusCode);
    }
    
    /**
     * send
     *
     * @param  string $component
     * @return void
     */
    public function send(string $component = 'front'): void
    {
        exit($this->page->getGeneratedPage($component));
    }
    
    /**
     * setPage
     *
     * @param  Page $page
     * @return void
     */
    public function setPage(Page $page): void
    {
        $this->page = $page;
    }

    // Changement par rapport à la fonction setcookie() : le dernier argument est par défaut à true
    /**
     * setCookie
     *
     * @param  string $name
     * @param  string $value
     * @param  int $expire
     * @param  string  $path
     * @param  string $domain
     * @param  bool $secure
     * @param  bool $httpOnly
     * @return void
     */
    public function setCookie(string $name, string $value = '', int $expire = 0, string $path = null, string $domain = null, bool $secure = false, bool $httpOnly = true): void
    {
        setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
    }
}
