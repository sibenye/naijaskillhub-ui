<?php

function str_starts_with($haystack, $needle)
{
    return substr_compare($haystack, $needle, 0, strlen($needle)) === 0;
}

function str_ends_with($haystack, $needle)
{
    return substr_compare($haystack, $needle, -strlen($needle)) === 0;
}
