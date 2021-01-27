<?php

function escHtml(string $str)
{
    print_r(filter_var($str, FILTER_UNSAFE_RAW));
}

function escUrl(string $url)
{
    print_r(filter_var($url, FILTER_SANITIZE_URL));
}

function pathImage(string $path)
{
    print_r(filter_var('..' . $path, FILTER_SANITIZE_URL));
}