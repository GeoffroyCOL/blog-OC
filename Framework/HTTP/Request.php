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
        return (filter_input(INPUT_COOKIE, $key, FILTER_SANITIZE_SPECIAL_CHARS) !== null) ? filter_input(INPUT_COOKIE, $key, FILTER_SANITIZE_SPECIAL_CHARS) : null;
    }
    
    /**
     * cookieExists
     *
     * @param  string $key
     * @return bool
     */
    public function cookieExists(string $key): bool
    {
        return filter_input(INPUT_COOKIE, $key, FILTER_SANITIZE_SPECIAL_CHARS) !== null;
    }
    
    /**
     * getData
     *
     * @param  string $key
     * @return string|null
     */
    public function getData(string $key): ?string
    {
        return filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS) !== null ? filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS) : null;
    }
    
    /**
     * getExists
     *
     * @param  mixed $key
     * @return void
     */
    public function getExists(string $key)
    {
        return filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS) !== null;
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
        return filter_input(INPUT_POST, $key) !== null ? filter_input(INPUT_POST, $key) : null;
    }
    
    /**
     * postExists
     *
     * @param  string $key
     * @return bool
     */
    public function postExists(string $key): bool
    {
        return filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS) !== null;
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
