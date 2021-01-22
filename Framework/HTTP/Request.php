<?php

namespace Framework\HTTP;

use Framework\App\ComponentFramework;

class Request
{    
    /**
     * cookieData
     *
     * @param  string $key
     * @return string|null
     */
    public function cookieData(string $key): ?string
    {
        return isset($_COOKIE[$key]) ? filter_input(INPUT_COOKIE, $key, FILTER_SANITIZE_SPECIAL_CHARS) : null;
    }
    
    /**
     * cookieExists
     *
     * @param  string $key
     * @return bool
     */
    public function cookieExists(string $key): bool
    {
        return isset($_COOKIE[$key]);
    }
    
    /**
     * getData
     *
     * @param  string $key
     * @return string|null
     */
    public function getData(string $key): ?string
    {
        return isset($_GET[$key]) ? filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS) : null;
    }
    
    /**
     * getExists
     *
     * @param  mixed $key
     * @return void
     */
    public function getExists(string $key)
    {
        return isset($_GET[$key]);
    }
    
    /**
     * method
     *
     * @return string
     */
    public function method(): string
    {
        return filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_SPECIAL_CHARS);
    }
    
    /**
     * postData
     *
     * @param  string $key
     * @return string|null
     */
    public function postData(string $key): ?string
    {
        return isset($_POST[$key]) ? filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS) : null;
    }
    
    /**
     * postExists
     *
     * @param  string $key
     * @return bool
     */
    public function postExists(string $key): bool
    {
        return isset($_POST[$key]);
    }
    
    /**
     * requestURI
     *
     * @return array
     */
    public function requestURI(): array
    {
        return parse_url(filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL));
    }
}
