<?php

function str_starts_with($haystack, $needle)
{
    return substr_compare($haystack, $needle, 0, strlen($needle)) === 0;
}

function str_ends_with($haystack, $needle)
{
    return substr_compare($haystack, $needle, -strlen($needle)) === 0;
}

/**
 * Decodes a json object.
 *
 * @param string $string The string to decode.
 *
 * @return associative array.
 * @throws \Exception Response is not a valid JSON string.
 */
function convertToAssociativeArray($string)
{
    $responseArray = json_decode($string, true);

    return $responseArray;
}
