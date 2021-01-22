<?php

function escHtml(string $str)
{
    print_r(filter_var($str, FILTER_UNSAFE_RAW));
}